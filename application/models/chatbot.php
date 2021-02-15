<?php
class Chatbot extends CI_model
{

  function getinfo($usn)
  {
    $ssi_id=$this->getssi($usn);
    if ($ssi_id!="none") {
      $acctno=$this->getacctno($usn);
      $data=array();
      $DB2 = $this->load->database('db2', TRUE);//sis_main_db
      $query = $DB2->query("SELECT
        sis_main_db.student_enrollment_stat.sch_year,
        sis_main_db.student_enrollment_stat.semester,
        sis_main_db.program_list.prog_abv,
        program_list.`level`,
        sis_main_db.`year`.current_stat,
        CONCAT(stud_per_info.lname,', ',stud_per_info.fname,' ',stud_per_info.mname) AS fullname,
        Max(sis_main_db.student_enrollment_stat.ses_id),
        `year`.`year`
      FROM
        stud_sch_info
        INNER JOIN student_enrollment_stat ON student_enrollment_stat.ssi_id = stud_sch_info.ssi_id
        INNER JOIN stud_program ON stud_program.ssi_id = stud_sch_info.ssi_id AND student_enrollment_stat.sch_year = stud_program.sch_year AND student_enrollment_stat.semester = stud_program.semester
        INNER JOIN program_list ON stud_program.pl_id = program_list.pl_id
        INNER JOIN `year` ON `year`.ssi_id = stud_sch_info.ssi_id AND stud_program.sch_year = `year`.sch_year AND stud_program.semester = `year`.semester
  			INNER JOIN stud_per_info ON stud_per_info.spi_id = stud_sch_info.spi_id
      WHERE
        student_enrollment_stat.ssi_id = '{$ssi_id}'
      GROUP BY
        sis_main_db.stud_program.sp_id
      ORDER BY
        sis_main_db.stud_program.sp_id DESC
      LIMIT 1");
      if ($query->num_rows() > 0)
      {
        foreach ($query->result() as $row)
        {
            $sch_year=$row->sch_year;
            $semester=$row->semester;
            $course=$row->prog_abv;
            $current_stat=$row->current_stat;
            $year=$row->year;
            $level=$row->level;
            $fullname=$row->fullname;
        }
      }
      $prelim=0.45;
  		$midterm=0.65;
  		$prefinal=0.85;
  		$final=1;
      $dl1="";
  		$dl2="";
  		$dl3="";
  		$dl4="";
      $percent = $this->db->query("SELECT
  			fee_schedule.label,
  			fee_schedule.percent,
  			fee_schedule.payDate AS `deadline`
      FROM
  			fee_schedule
  		INNER JOIN sem ON fee_schedule.semId = sem.semId
  		INNER JOIN sy ON fee_schedule.syId = sy.syId
      ORDER BY
      fee_schedule.feeSchedId DESC
      LIMIT 4");
  		if ($percent->num_rows() > 0)
  		{
  			foreach ($percent->result() as $row1)
  			{
  				if ($row1->label=="Prelim") {
  					$prelim=$row1->percent;
  					$dl1=$row1->deadline;
  				}
  				else if ($row1->label=="Midterm")
  				{
  					$midterm=$row1->percent;
  					$dl2=$row1->deadline;
  				}
  				else if ($row1->label=="PreFinal")
  				{
  					$prefinal=$row1->percent;
  					$dl3=$row1->deadline;
  				}
  				else if ($row1->label=="Final")
  				{
  					$final=$row1->percent;
  					$dl4=$row1->deadline;
  				}
  			}

  		}
  		if ($level!="College")
  		{
  			$prelim=0.25;
  			$midterm=0.25;
  			$prefinal=0.25;
  			$final=0.25;
  		}
      $syId=$this->getid($sch_year,"sy");
  		$semId=$this->getid($semester,"sem");
      $data[]=[
        'sch_year'=>$sch_year,
        'semester'=>$semester,
        'course'=>$course,
        'current_stat'=>$current_stat,
        'year'=>$year,
        'level'=>$level,
        'fullname'=>$fullname,
        'prelimdeadline'=>$dl1,
        'midtermdeadline'=>$dl2,
        'prefinaldeadline'=>$dl3,
        'finaldeadline'=>$dl4,
        'assessment'=>$this->getAssessment2($ssi_id,"misc",$syId,$semId),
        'bridging'=>$this->getAssessment2($ssi_id,"bridging",$syId,$semId),
        'tutorial'=>$this->getAssessment2($ssi_id,"tutorial",$syId,$semId),
        'discount'=>$this->getDiscount2($ssi_id,$syId,$semId),
        'oldsystem'=>$this->checkoldsys($acctno),
        'assessmentPayments'=>$this->getPayment2($ssi_id,"misc",$syId,$semId),
        'paymentsHistory'=>$this->getPayment($ssi_id,"misc"),
        'bridgingPayments'=>$this->getPayment2($ssi_id,"bridging",$syId,$semId),
        'tutorialPayments'=>$this->getPayment2($ssi_id,"tutorial",$syId,$semId),
        'bridgingHistory'=>$this->getPayment($ssi_id,"bridging"),
        'tutorialHistory'=>$this->getPayment($ssi_id,"tutorial"),
        'oldsystembreakdown'=>$this->oldsystembreakdown($acctno),
        'oldaccnewsys'=>$this->newsysoldacc($ssi_id,$syId,$semId)
      ];
    }else {
      $data[]=['fullname'=>"not found"];
    }

    return json_encode($data);
  }
  //get syid/semid
	function getid($val,$table)
	{
		$id="";
		if ($table=="sy") {
			$id="syId";
		}
		else
		{
			$id="semId";
		}
		$query = $this->db->query("SELECT
			{$table}.{$id} AS `data`
		FROM
			{$table}
		WHERE
			{$table}.{$table} = '{$val}'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				return $row->data;
			}
		}

	}
  //new systemoldacc
	function newsysoldacc($ssi_id,$syId,$semId)
	{
		$data=array();
		$queryass = $this->db->query("SELECT
			sy.sy,
			sem.sem,
			SUM(assessment.amt2) AS `ass`,
			assessment.syId,
			assessment.semId
		FROM
			assessment
		INNER JOIN sy ON assessment.syId = sy.syId
		INNER JOIN sem ON assessment.semId = sem.semId
		WHERE
			assessment.ssi_id = '{$ssi_id}' AND
			(assessment.feeType <> 'Tutorial' AND
			assessment.feeType <> 'Bridging') AND
			(assessment.syId <> '{$syId}' OR
			assessment.semId <> '{$semId}')
		GROUP BY
			assessment.syId,
			assessment.semId
		ORDER BY
			assessment.syId DESC,
			assessment.semId DESC");
		if ($queryass->num_rows() > 0)
		{
			foreach ($queryass->result() as $rowass)
			{
				$discount=$this->getDiscount2($ssi_id,$rowass->syId,$rowass->semId);
				$asspay=$this->getPayment2($ssi_id,"misc",$rowass->syId,$rowass->semId);
				$bridging=$this->getAssessment2($ssi_id,"bridging",$rowass->syId,$rowass->semId);
				$bridgpay=$this->getPayment2($ssi_id,"bridging",$rowass->syId,$rowass->semId);
				$tutorial=$this->getAssessment2($ssi_id,"tutorial",$rowass->syId,$rowass->semId);
				$tutorialpay=$this->getPayment2($ssi_id,"tutorial",$rowass->syId,$rowass->semId);
				$ass=$rowass->ass-$discount-$asspay;
				$brid=$bridging-$bridgpay;
				$tutor=$tutorial-$tutorialpay;
				$data[]=['sy'=>$rowass->sy,'sem'=>$rowass->sem,'ass'=>$ass,'bridg'=>$brid,'tutor'=>$tutor];
			}
		}
		return	$data;
	}
	//get discount2
  function getDiscount2($ssi_id,$syId,$semId)
  {
		$disc=0;
    $query = $this->db->query("SELECT
      IFNULL(sum(discount.amt2),0) AS `amt2`
    FROM
      discount
    INNER JOIN sy ON discount.syId = sy.syId
    INNER JOIN sem ON discount.semId = sem.semId
    WHERE
      discount.ssi_id = '{$ssi_id}'AND
			discount.syId = '{$syId}' AND
			discount.semId = '{$semId}'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $disc=$row->amt2;
			}
		}
    return $disc;
  }
	// get payment
	function getPayment2($ssi_id,$set,$syId,$semId)
  {
		$payment=0;
    if ($set=="bridging")
    {
      $set="AND assessment.feeType = 'Bridging'";
    }
    elseif ($set=="tutorial")
    {
      $set="AND assessment.feeType = 'Tutorial'";
    }
    elseif($set=="misc")
    {
      $set=" AND (assessment.feeType <> 'Tutorial' AND assessment.feeType <> 'Bridging')";
    }
    $query = $this->db->query("SELECT
			IFNULL(Sum(paymentdetails.amt2),0) AS amt2
		FROM
      payments
    INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
    LEFT JOIN assessment ON paymentdetails.assessmentId = assessment.assessmentId AND payments.semId = assessment.semId AND payments.syId = assessment.syId
    INNER JOIN sy ON payments.syId = sy.syId
    INNER JOIN sem ON payments.semId = sem.semId
		WHERE
		 payments.ssi_id = '{$ssi_id}' ".$set." AND
		 payments.syId = '{$syId}' AND
		 payments.semId = '{$semId}'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $payment=$row->amt2;
			}
		}
    return $payment;
  }
	//get assessment/tutorial/bridging2
  function getAssessment2($ssi_id,$set,$syId,$semId)
  {
    $part=0;
    if ($set=="bridging")
    {
      $set="AND assessment.feeType = 'Bridging'";
    }
    elseif ($set=="tutorial")
    {
      $set="AND assessment.feeType = 'Tutorial'";
    }
    else
    {
      $set="AND (assessment.feeType <> 'Tutorial' AND assessment.feeType <> 'Bridging')";
    }
    $query = $this->db->query("SELECT
      IFNULL(sum(assessment.amt2),0) AS amt2
    FROM
      assessment
    INNER JOIN sy ON assessment.syId = sy.syId
    INNER JOIN sem ON assessment.semId = sem.semId
    WHERE
    	assessment.ssi_id = '{$ssi_id}' ".$set." AND
 		 	assessment.syId = '{$syId}' AND
 		 	assessment.semId = '{$semId}'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $part=$row->amt2;
			}
		}
    return $part;
  }
  //get total amount
	function getamt($query)
	{
		$DB4 = $this->load->database('db4', TRUE);
		$amt=0;
		$query1 = $DB4->query($query);
		if ($query1->num_rows() > 0)
		{
			foreach ($query1->result() as $row1)
			{
				$amt=$row1->amt;
			}
		}
		return $amt;
	}
  //old system old account summary
	function checkoldsys($acctno)
	{
		$DB4 = $this->load->database('db4', TRUE);
		$data=array();
		$balance=0;
		$assesstotal=0;
		$discount=0;
		$payment=0;
		$bridgtotal=0;
		$bridgpayment=0;
		$tutortotal=0;
		$query = $DB4->query("SELECT
				enrolled.course,
				enrolled.sem,
				enrolled.sy,
				enrolled.`status`
			FROM
				enrolled
			WHERE
				enrolled.acctno = '{$acctno}' AND
				enrolled.course NOT LIKE '%bridg'
			ORDER BY
				enrolled.sy DESC,
				enrolled.sem DESC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$course=$row->course;
				$sem=$row->sem;
				$sy=$row->sy;
				$status=$row->status;
				//assessment
				$assesstotal=$this->getamt("SELECT
						IFNULL(Sum(tbl_assessment_copy.amt),0) as `amt`
					FROM
						tbl_assessment_copy
					WHERE
						tbl_assessment_copy.acctno = '{$acctno}' AND
						tbl_assessment_copy.sy = '{$sy}' AND
						tbl_assessment_copy.sem = '{$sem}'"
				);
				//discount
				$discount=$this->getamt("SELECT
						IFNULL(Sum(tbl_discount2.amt),0) as `amt`
					FROM
						tbl_discount2
					WHERE
						tbl_discount2.acctno = '{$acctno}' AND
						tbl_discount2.sy = '{$sy}' AND
						tbl_discount2.sem = '{$sem}'"
				);
				//payment
				$payment=$this->getamt("SELECT
						IFNULL(Sum(payment.Amt),0) AS `amt`
					FROM
						payment
					WHERE
						payment.acctno = '{$acctno}' AND
						payment.SY = '{$sy}' AND
						payment.SEM = '{$sem}' AND
						payment.`MODE` = 'cash'"
				);
				$balance=$assesstotal-$discount-$payment;
				if(strpos($course, "SENIORHIGH") !== false){
					//bridging
					$bridgtotal=$this->getamt("SELECT
							(Sum(tbl_schedule.Total_credit_unit)*(SELECT
								course.Unit
							From
								course
							Where
								course.sy = '{$sy}' AND
								course.sem = '{$sem}' AND
								course.course = '{$course}' AND
								course.`status` = '{$status}' LIMIT 1)) as `amt`
						From
							tbl_stud_load
						INNER JOIN tbl_bridging_subj ON tbl_stud_load.Subject_code = tbl_bridging_subj.Subject_code
						INNER JOIN tbl_schedule ON tbl_stud_load.Subject_code = tbl_schedule.Subject_code
						Where
							tbl_bridging_subj.sem = '{$sem}' AND
							tbl_bridging_subj.sy = '{$sy}' AND
							tbl_stud_load.sem_load = '{$sem}' AND
							tbl_stud_load.yearLoad = '{$sy}' AND
							tbl_stud_load.acctno = '{$acctno}'"
					);
					//bridging payment
					$bridgpayment=$this->getamt("SELECT
							Sum(tbl_bridging_payment.amount) as `amt`
						FROM `tbl_bridging_payment`
						WHERE
							`sem` = '{$sem}' AND
							`sy` = '{$sy}' AND
							`acctno` = '{$acctno}'"
					);
					$bridgtotal=$bridgtotal-$bridgpayment;
				}
				else
				{
					$tutortotal=$this->gettutorial($sy,$sem,$course,$status,$acctno);
				}
				$balance=round($balance,2);
				$bridgtotal=round($bridgtotal,2);
				$tutortotal=round($tutortotal,2);
				if ($balance<0) {
					$balance=0;
				}
				if ($bridgtotal<0) {
					$bridgtotal=0;
				}
				if ($tutortotal<0) {
					$tutortotal=0;
				}
				if ($balance>0 OR $bridgtotal>0 OR $tutortotal>0) {
					$data[]=["sy"=>$sy,"sem"=>$sem,"ass"=>$balance,"bridg"=>$bridgtotal,"tutorial"=>$tutortotal];
				}
			}
		}
		return $data;
	}
  // tutorial old
	function gettutorial($sy,$sem,$course,$status,$acctno)
	{
		$DB4 = $this->load->database('db4', TRUE);
		$amt=0;
		$tpu=0;
		$nou=0;
		$rnoe=15;
		$noe=0;
		$pay=0;
		$query1 = $DB4->query("SELECT
			course.Unit
		From
			course
		Where
			course.sy = '{$sy}' AND
			course.sem = '{$sem}' AND
			course.course = '{$course}' AND
			course.`status` = '{$status}'");
		if ($query1->num_rows() > 0)
		{
			foreach ($query1->result() as $row1)
			{
				$tpu=$row1->Unit;
			}
		}
		$query2 = $DB4->query("SELECT
			tbl_schedule.no_of_enrollees,
			tbl_schedule.Total_credit_unit
		From
			tbl_stud_load
		INNER JOIN tbl_tutorial_subj ON tbl_stud_load.Subject_code = tbl_tutorial_subj.Subject_code
		INNER JOIN tbl_schedule ON tbl_stud_load.Subject_code = tbl_schedule.Subject_code
		Where
			tbl_tutorial_subj.sem = '{$sem}' AND
			tbl_tutorial_subj.sy = '{$sy}' AND
			tbl_stud_load.sem_load = '{$sem}' AND
			tbl_stud_load.yearLoad = '{$sy}' AND
			tbl_stud_load.acctno = '{$acctno}'
		Group by tbl_stud_load.Subject_code ");
		if ($query2->num_rows() > 0)
		{
			foreach ($query2->result() as $row2)
			{
				$noe=$row2->no_of_enrollees;
				$nou=$row2->Total_credit_unit;
				$amt+=($tpu*$nou*($rnoe-$noe))/$noe;
			}
		}
		$query3 = $DB4->query("SELECT
			Sum(tbl_tut_payment_details.amount) AS `amt`
		From tbl_tutorial_payment
		INNER JOIN tbl_tut_payment_details ON tbl_tutorial_payment.tut_payment_ID = tbl_tut_payment_details.tut_payment_ID
		WHERE
			tbl_tutorial_payment.acctno = '{$acctno}' AND
			tbl_tutorial_payment.sy = '{$sy}' AND
			tbl_tutorial_payment.sem = '{$sem}'");
		if ($query3->num_rows() > 0)
		{
			foreach ($query3->result() as $row3)
			{
				$pay+=$row3->amt;
			}
		}
		if($amt>0)
		{
			$amt=$amt-$pay;
		}
		return round($amt);
	}
  //get ssi_id & acctno
  function getssi($usn)
  {
    $DB2 = $this->load->database('db2', TRUE);//sis_main_db
    $DB3 = $this->load->database('db3', TRUE);//curriculum_final
    $DB4 = $this->load->database('db4', TRUE);//datbaseama
    $ssi_id="none";
    $query = $DB2->query("SELECT
      stud_sch_info.ssi_id
    FROM
      stud_sch_info
    WHERE
      stud_sch_info.stud_id = '{$usn}'");
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $ssi_id=$row->ssi_id;
      }
    }
    return $ssi_id;
  }

  function getacctno($usn)
  {
    $DB2 = $this->load->database('db2', TRUE);//sis_main_db
    $DB3 = $this->load->database('db3', TRUE);//curriculum_final
    $DB4 = $this->load->database('db4', TRUE);//datbaseama
    $acctno="";
    $query = $DB2->query("SELECT
      stud_sch_info.acct_no
    FROM
      stud_sch_info
    WHERE
      stud_sch_info.stud_id = '{$usn}'");
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $acctno=$row->acct_no;
      }
    }
    return $acctno;
  }


  //old System
  function oldsystembreakdown($acctno)
  {
    $DB4 = $this->load->database('db4', TRUE);
    $assessment=array();
    $discount=array();
    $payment=array();
    $bridging=array();
    $bridgingpay=array();
    $data=array();
    $tutorial=array();
    $tutorialpayment=array();
    $query = $DB4->query("SELECT
        enrolled.course,
        enrolled.sem,
        enrolled.sy,
        enrolled.`status`
      FROM
        enrolled
      WHERE
        enrolled.acctno = '{$acctno}'
      ORDER BY
        enrolled.sy DESC,
        enrolled.sem DESC");
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $course=$row->course;
        $sem=$row->sem;
        $sy=$row->sy;
        $status=$row->status;
        //assessment
        $query1 = $DB4->query("SELECT
          tbl_assessment_copy.particular,
          tbl_assessment_copy.amt
        FROM
          tbl_assessment_copy
        WHERE
          tbl_assessment_copy.acctno = '{$acctno}' AND
          tbl_assessment_copy.sy = '{$sy}' AND
          tbl_assessment_copy.sem = '{$sem}'");
        if ($query1->num_rows() > 0)
        {
          foreach ($query1->result() as $row1)
          {
            $assessment[]=['sy'=>$sy,'sem'=>$sem,'particular'=>$row1->particular,'amt'=>$row1->amt];
          }
        }
        $query2 = $DB4->query("SELECT
          tbl_discount2.discount,
          tbl_discount2.amt
        FROM
          tbl_discount2
        WHERE
          tbl_discount2.acctno = '{$acctno}' AND
          tbl_discount2.sy = '{$sy}' AND
          tbl_discount2.sem = '{$sem}'");
        if ($query2->num_rows() > 0)
        {
          foreach ($query2->result() as $row2)
          {
            $discount[]=['sy'=>$sy,'sem'=>$sem,'discount'=>$row2->discount,'amt'=>$row2->amt];
          }
        }
        $query3 = $DB4->query("SELECT
          payment.Date,
          payment.`OR`,
          ordetails.Particular,
          ordetails.PAmt
        FROM
          payment
        LEFT JOIN ordetails ON payment.`OR` = ordetails.`OR` AND payment.acctno = ordetails.acctno
        WHERE
          payment.acctno = '{$acctno}' AND
          payment.SY = '{$sy}' AND
          payment.SEM = '{$sem}' AND
          payment.`MODE` = 'cash'");
        if ($query3->num_rows() > 0)
        {
          foreach ($query3->result() as $row3)
          {
            $payment[]=['sy'=>$sy,'sem'=>$sem,'date'=>$row3->Date,'or'=>$row3->OR,'particular'=>$row3->Particular,'amt'=>$row3->PAmt];
          }
        }
        if(strpos($course, "SENIORHIGH") !== false){
          $query4 = $DB4->query("SELECT
            tbl_schedule.Subject_description,
            (tbl_schedule.Total_credit_unit*(SELECT
              course.Unit
            From
              course
            Where
              course.sy = '{$sy}' AND
              course.sem = '{$sem}' AND
              course.course = '{$course}' AND
              course.`status` = '{$status}' LIMIT 1)) as `amt`
          From
            tbl_stud_load
          INNER JOIN tbl_bridging_subj ON tbl_stud_load.Subject_code = tbl_bridging_subj.Subject_code
          INNER JOIN tbl_schedule ON tbl_stud_load.Subject_code = tbl_schedule.Subject_code
          Where
            tbl_bridging_subj.sem = '{$sem}' AND
            tbl_bridging_subj.sy = '{$sy}' AND
            tbl_stud_load.sem_load = '{$sem}' AND
            tbl_stud_load.yearLoad = '{$sy}' AND
            tbl_stud_load.acctno = '{$acctno}'");
          if ($query4->num_rows() > 0)
          {
            foreach ($query4->result() as $row4)
            {
              $bridging[]=['sy'=>$sy,'sem'=>$sem,'subject'=>$row4->Subject_description,'amt'=>$row4->amt];
            }
          }
          $querypay = $DB4->query("SELECT
            tbl_bridging_payment.date,
            tbl_bridging_payment.tut_bridging_ID,
            tbl_bridging_payment_detail.amount,
            tbl_stud_load.Subject_description
          FROM
            tbl_bridging_payment
          INNER JOIN tbl_bridging_payment_detail ON tbl_bridging_payment.tut_bridging_ID = tbl_bridging_payment_detail.tut_bridging_ID
          INNER JOIN tbl_stud_load ON tbl_bridging_payment_detail.Subject_code = tbl_stud_load.Subject_code
          WHERE
            tbl_bridging_payment.sy = '{$sy}' AND
            tbl_bridging_payment.sem = '{$sem}' AND
            tbl_bridging_payment.acctno = '{$acctno}'AND
            tbl_stud_load.acctno = '{$acctno}'");
          if ($querypay->num_rows() > 0)
          {
            foreach ($querypay->result() as $rowpay)
            {
              $bridgingpay[]=['sy'=>$sy,'sem'=>$sem,'or'=>$rowpay->tut_bridging_ID,'date'=>$rowpay->date,'subject'=>$rowpay->Subject_description,'amt'=>$rowpay->amount];
            }
          }

        }
        else
        {
          $amt=0;
          $tpu=0;
          $nou=0;
          $rnoe=15;
          $noe=0;
          $pay=0;
          $query5 = $DB4->query("SELECT
            course.Unit
          From
            course
          Where
            course.sy = '{$sy}' AND
            course.sem = '{$sem}' AND
            course.course = '{$course}' AND
            course.`status` = '{$status}'");
          if ($query5->num_rows() > 0)
          {
            foreach ($query5->result() as $row5)
            {
              $tpu=$row5->Unit;
            }
          }
          $query6 = $DB4->query("SELECT
            tbl_schedule.no_of_enrollees,
            tbl_schedule.Total_credit_unit,
            tbl_stud_load.Subject_description
          From
            tbl_stud_load
          INNER JOIN tbl_tutorial_subj ON tbl_stud_load.Subject_code = tbl_tutorial_subj.Subject_code
          INNER JOIN tbl_schedule ON tbl_stud_load.Subject_code = tbl_schedule.Subject_code
          Where
            tbl_tutorial_subj.sem = '{$sem}' AND
            tbl_tutorial_subj.sy = '{$sy}' AND
            tbl_stud_load.sem_load = '{$sem}' AND
            tbl_stud_load.yearLoad = '{$sy}' AND
            tbl_stud_load.acctno = '{$acctno}'
          Group by tbl_stud_load.Subject_code");
          if ($query6->num_rows() > 0)
          {
            foreach ($query6->result() as $row6)
            {
              $noe=$row6->no_of_enrollees;
              $nou=$row6->Total_credit_unit;
              $amt=($tpu*$nou*($rnoe-$noe))/$noe;
              $tutorial[]=['sy'=>$sy,'sem'=>$sem,'subject'=>$row6->Subject_description,'amt'=>$amt];
            }
          }
          $query7 = $DB4->query("SELECT
            tbl_tutorial_payment.tut_payment_ID,
            tbl_tutorial_payment.date,
            tbl_stud_load.Subject_description,
            tbl_tut_payment_details.amount
          FROM
            tbl_tutorial_payment
          INNER JOIN tbl_tut_payment_details ON tbl_tutorial_payment.tut_payment_ID = tbl_tut_payment_details.tut_payment_ID
          LEFT JOIN tbl_stud_load ON tbl_tut_payment_details.Subject_code = tbl_stud_load.Subject_code AND tbl_tutorial_payment.sem = tbl_stud_load.sem_load AND tbl_tutorial_payment.sy = tbl_stud_load.yearLoad AND tbl_tutorial_payment.acctno = tbl_stud_load.acctno
          WHERE
            tbl_tutorial_payment.acctno = '{$acctno}' AND
            tbl_tutorial_payment.sy = '{$sy}' AND
            tbl_tutorial_payment.sem = '{$sem}'");
          if ($query7->num_rows() > 0)
          {
            foreach ($query7->result() as $row7)
            {
              $tutorialpayment[]=['sy'=>$sy,'sem'=>$sem,'or'=>$row7->tut_payment_ID,'date'=>$row7->date,'subject'=>$row7->Subject_description,'amt'=>$row7->amount];
            }
          }
        }
      }
      $data=['assessment'=>$assessment,'discount'=>$discount,'payment'=>$payment,'bridging'=>$bridging,'bridgingpay'=>$bridgingpay,'tutorial'=>$tutorial,'tutorialpayment'=>$tutorialpayment];
    }
    return $data;
  }





  //assessment
  function getAssessment($ssi_id,$set)
  {
    $assessment=array();
    if ($set=="bridging")
    {
      $set="AND assessment.feeType = 'Bridging'";
    }
    elseif ($set=="tutorial")
    {
      $set="AND assessment.feeType = 'Tutorial'";
    }
    else
    {
      $set="AND (assessment.feeType <> 'Tutorial' AND assessment.feeType <> 'Bridging')";
    }
    $query = $this->db->query("SELECT
      sy.sy,
      sem.sem,
      assessment.particular,
      assessment.amt1,
      assessment.amt2,
      assessment.feeType
    FROM
      assessment
    INNER JOIN sy ON assessment.syId = sy.syId
    INNER JOIN sem ON assessment.semId = sem.semId
    WHERE
      assessment.ssi_id = '{$ssi_id}' ".$set."
    ORDER BY
      sy.sy DESC,
      sem.sem DESC,
      assessment.feeType ASC");
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $assessment[]=["sy"=>$row->sy,"sem"=>$row->sem,"particular"=>$row->particular,"amt1"=>$row->amt1,"amt2"=>$row->amt2,"feeType"=>$row->feeType];
      }
    }
    return $assessment;
  }



  //discounts
  function getDiscount($ssi_id)
  {
    $discount=array();
    $query = $this->db->query("SELECT
      sy.sy,
      sem.sem,
      discount.discountDesc,
      discount.amt1,
      discount.amt2
    FROM
      discount
    INNER JOIN sy ON discount.syId = sy.syId
    INNER JOIN sem ON discount.semId = sem.semId
    WHERE
      discount.ssi_id = '{$ssi_id}'
    ORDER BY
      sy.sy DESC,
      sem.sem DESC");
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $discount[]=["sy"=>$row->sy,"sem"=>$row->sem,"discountDesc"=>$row->discountDesc,"amt1"=>$row->amt1,"amt2"=>$row->amt2];
      }
    }
    return $discount;
  }

  function getPayment($ssi_id,$set)
  {
    $payment=array();
    if ($set=="bridging")
    {
      $set="AND assessment.feeType = 'Bridging'";
    }
    elseif ($set=="tutorial")
    {
      $set="AND assessment.feeType = 'Tutorial'";
    }
    elseif($set=="misc")
    {
      $set=" AND (assessment.feeType <> 'Tutorial' AND assessment.feeType <> 'Bridging')";
    }
    $query = $this->db->query("SELECT
      sy.sy,
      sem.sem,
      payments.orNo,
      payments.paymentDate,
      assessment.feeType,
      Sum(paymentdetails.amt1) AS amt1,
      Sum(paymentdetails.amt2) AS amt2
    FROM
      payments
    INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
    LEFT JOIN assessment ON paymentdetails.assessmentId = assessment.assessmentId AND payments.semId = assessment.semId AND payments.syId = assessment.syId
    INNER JOIN sy ON payments.syId = sy.syId
    INNER JOIN sem ON payments.semId = sem.semId
    WHERE
     payments.ssi_id = '{$ssi_id}' ".$set."
    GROUP BY
      sy.sy,
      sem.sem,
      payments.orNo,
      payments.paymentDate,
      assessment.feeType
    ORDER BY
      sy.sy DESC,
      sem.sem DESC,
      payments.paymentDate ASC,
      assessment.priority ASC");
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $payment[]=["sy"=>$row->sy,"sem"=>$row->sem,"orNo"=>$row->orNo,"paymentDate"=>$row->paymentDate,"feeType"=>$row->feeType,"amt1"=>$row->amt1,"amt2"=>$row->amt2];
      }
    }
    return $payment;
  }
}
?>
