<?php
class Model extends CI_Model
{
  //generate sy in login
	function updatesy($sy)
	{
		$query = $this->db->query("SELECT
			sy.sy
		FROM `sy`
		WHERE
			sy.sy = '$sy'")->num_rows();

		if ($query == 0 ) {
			echo $this->db->set('sy', $sy)->get_compiled_insert('sy', FALSE);
			return $this->db->insert('sy',$arr);
		}
	}
  //search student in fees
	function searchstudent($student)
	{
    $DB2 = $this->load->database('db2', TRUE);//sis_main_db
    $DB3 = $this->load->database('db3', TRUE);//curriculum_final
    $DB4 = $this->load->database('db4', TRUE);//datbaseama
		$query = $DB2->query("SELECT
			stud_per_info.lname,
			stud_per_info.fname,
			stud_per_info.mname,
			stud_sch_info.acct_no,
			stud_sch_info.ssi_id
		FROM
			stud_per_info
		INNER JOIN stud_sch_info ON stud_sch_info.spi_id = stud_per_info.spi_id
		WHERE
			stud_per_info.lname LIKE '{$student}%'
		ORDER BY
			stud_per_info.lname ASC,
			stud_per_info.fname ASC")->result();

		return json_encode($query);
	}
  // generate student info
  function searchinfo($ssi_id,$sem,$sy,$acctno)
  {
    $DB2 = $this->load->database('db2', TRUE);//sis_main_db
    $DB3 = $this->load->database('db3', TRUE);//curriculum_final
    $DB4 = $this->load->database('db4', TRUE);//datbaseama
		$data=array();
    $query = $DB2->query("SELECT
      student_enrollment_stat.`status`,
      student_enrollment_stat.sch_year,
      student_enrollment_stat.semester,
      program_list.prog_abv,
      `year`.year_stat,
      `year`.current_stat,
      `year`.is_graduating,
      program_list.`level`,
      stud_sch_info.usn_no,
			CONCAT(stud_per_info.lname,', ',stud_per_info.fname,' ',stud_per_info.mname) AS `fullname`
    FROM
      stud_sch_info
      INNER JOIN student_enrollment_stat ON student_enrollment_stat.ssi_id = stud_sch_info.ssi_id
      INNER JOIN stud_program ON stud_program.ssi_id = stud_sch_info.ssi_id AND student_enrollment_stat.sch_year = stud_program.sch_year AND student_enrollment_stat.semester = stud_program.semester
      INNER JOIN program_list ON stud_program.pl_id = program_list.pl_id
      INNER JOIN `year` ON `year`.ssi_id = stud_sch_info.ssi_id AND stud_program.sch_year = `year`.sch_year AND stud_program.semester = `year`.semester
			INNER JOIN stud_per_info ON stud_per_info.spi_id = stud_sch_info.spi_id
		WHERE
      student_enrollment_stat.ssi_id = '{$ssi_id}' AND
      student_enrollment_stat.sch_year = '{$sy}' AND
      student_enrollment_stat.semester = '{$sem}'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=[
					'fullname'=>$row->fullname,
					'status'=>$row->status,
					'course'=>$row->prog_abv,
					'yearStatus'=>$row->year_stat,
					'studentStatus'=>$row->current_stat,
					'is_graduating'=>$row->is_graduating,
					'level'=>$row->level,
					'usn_no'=>$row->usn_no,
					'assessment'=>$this->getAssessment($ssi_id,"misc"),
					'bridging'=>$this->getAssessment($ssi_id,"bridging"),
					'tutorial'=>$this->getAssessment($ssi_id,"tutorial"),
					'discount'=>$this->getDiscount($ssi_id),
					'assessmentPayments'=>$this->getPayment($ssi_id,"misc"),
					'bridgingPayments'=>$this->getPayment($ssi_id,"bridging"),
					'tutorialPayments'=>$this->getPayment($ssi_id,"tutorial"),
					'otherPayments'=>$this->getPayment($ssi_id,"others"),
					'studload'=>$this->getStudload($ssi_id)
				];
			}
		}
		return json_encode($data);
  }
  //get assessment/tutorial/bridging
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
  //get discount
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
  //get all payment
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
      $set="AND (assessment.feeType <> 'Tutorial' AND assessment.feeType <> 'Bridging')";
    }
    elseif($set=="others")
    {
      $set="AND particulars.feeType = 'others'";
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
    LEFT JOIN particulars ON paymentdetails.particularId = particulars.particularId AND payments.semId = particulars.semId AND payments.syId = particulars.syId
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
			sem.sem DESC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $payment[]=["sy"=>$row->sy,"sem"=>$row->sem,"orNo"=>$row->orNo,"paymentDate"=>$row->paymentDate,"feeType"=>$row->feeType,"amt1"=>$row->amt1,"amt2"=>$row->amt2];
			}
		}
    return $payment;
  }
  // get studload
  function getStudload($ssi_id)
  {
    $DB2 = $this->load->database('db2', TRUE);//sis_main_db
    $DB3 = $this->load->database('db3', TRUE);//curriculum_final
    $DB4 = $this->load->database('db4', TRUE);//datbaseama
    $studload=array();
    $query = $DB2->query("SELECT
      subject_enrolled.ss_id,
      subject_enrolled.sch_year,
      subject_enrolled.semester
    FROM
      subject_enrolled
    INNER JOIN subject_enrolled_status ON subject_enrolled.ses_id = subject_enrolled_status.ses_id
    WHERE
  		subject_enrolled.ssi_id = '{$ssi_id}' AND
  		(subject_enrolled_status.`status` = 'enrolled' OR
  		subject_enrolled_status.`status` = 'add' OR
      subject_enrolled_status.`status` = 'change')
    ORDER BY
      subject_enrolled.sch_year DESC,
      subject_enrolled.semester DESC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $query2 = $DB3->query("SELECT
					`subject`.subj_code,
					`subject`.subj_name,
					`subject`.lec_unit,
					`subject`.lab_unit,
					sched_day.abbreviation,
					subj_sched_day.time_start,
					subj_sched_day.time_end,
					room_list.room_code
				FROM
					sched_subj
				INNER JOIN `subject` ON sched_subj.subj_id = `subject`.subj_id
				INNER JOIN subj_sched_day ON subj_sched_day.ss_id = sched_subj.ss_id
				INNER JOIN sched_day ON subj_sched_day.sd_id = sched_day.sd_id
				INNER JOIN room_list ON subj_sched_day.rl_id = room_list.rl_id
				WHERE
					sched_subj.ss_id = '{$row->ss_id}'");
    		if ($query2->num_rows() > 0)
    		{
    			foreach ($query2->result() as $row2)
    			{
            $studload[]=["sy"=>$row->sch_year,"sem"=>$row->semester,"subj_code"=>$row2->subj_code,"subj_name"=>$row2->subj_name,"lec_unit"=>$row2->lec_unit,"lab_unit"=>$row2->lab_unit,"abbreviation"=>$row2->abbreviation,"time_start"=>$row2->time_start,"time_end"=>$row2->time_end,"room_code"=>$row2->room_code];
    			}
    		}
			}

		}
    return $studload;
  }



}
?>
