<?php

/**
*
*/
class Main_model extends CI_Model
{
  function validate()
  {
  	$arr['username']=$this->input->post('username');
  	$arr['password']=md5($this->input->post('password'));
  	return $this->db->get_where('users',$arr)->row();
  }
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
		$DB2 = $this->load->database('db2', TRUE);
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
  //generate student info
	function searchinfo($id,$sem,$sy,$acctno)
	{
		$DB2 = $this->load->database('db2', TRUE);
		$DB3 = $this->load->database('db3', TRUE);
		$data=array();
		$enrolled=array();
		$status=array();
		$studload=array();
		$payments=array();
		$discreditt=0;
		$discredit=array();

		unset($enrolled);
		$query2 = $DB2->query("SELECT DISTINCT
			student_enrollment_stat.`status`,
			student_enrollment_stat.sch_year,
			student_enrollment_stat.semester,
			program_list.prog_abv,
			`year`.year_stat
		FROM
			stud_sch_info
		INNER JOIN student_enrollment_stat ON student_enrollment_stat.ssi_id = stud_sch_info.ssi_id
		INNER JOIN stud_program ON stud_program.ssi_id = stud_sch_info.ssi_id AND student_enrollment_stat.sch_year = stud_program.sch_year AND student_enrollment_stat.semester = stud_program.semester
		INNER JOIN program_list ON stud_program.pl_id = program_list.pl_id
		INNER JOIN `year` ON `year`.ssi_id = stud_sch_info.ssi_id
		WHERE
			student_enrollment_stat.ssi_id = '{$id}'
		ORDER BY
			student_enrollment_stat.sch_year ASC,
			student_enrollment_stat.semester ASC");
		if ($query2->num_rows() > 0)
		{
			foreach ($query2->result() as $row2)
			{
				$enrolled[]=["sy"=>$row2->sch_year,"sem"=>$row2->semester,"status"=>$row2->year_stat,"course"=>$row2->prog_abv];
			}
		}
		else
		{
			$enrolled[]=["sy"=>'No Data',"sem"=>'No Data',"status"=>'No Data',"course"=>'No Data'];
		}

		unset($status);
		$query6 = $DB2->query("SELECT
			program_list.prog_abv,
			`year`.current_stat,
			program_list.`level`,
			`year`.`year`,
			stud_program.sch_year,
			stud_program.semester
		FROM
			stud_sch_info
		INNER JOIN stud_program ON stud_program.ssi_id = stud_sch_info.ssi_id
		INNER JOIN program_list ON stud_program.pl_id = program_list.pl_id
		INNER JOIN `year` ON `year`.ssi_id = stud_sch_info.ssi_id AND stud_program.semester = `year`.semester AND stud_program.sch_year = `year`.sch_year
		WHERE
			stud_sch_info.ssi_id = '{$id}' AND
			stud_program.sch_year = '{$sy}' AND
			stud_program.semester = '{$sem}'");
		if ($query6->num_rows() > 0)
		{
			foreach ($query6->result() as $row6)
			{

				$status[]=["sy"=>$row6->sch_year,"sem"=>$row6->semester,"status"=>'enrolled',"course"=>$row6->prog_abv,"current_stat"=>$row6->current_stat,"level"=>$row6->level];
			}
		}
		else
		{
			$status[]=["sy"=>'No Data',"sem"=>'No Data',"status"=>'No Data',"course"=>'No Data',"current_stat"=>'No Data',"level"=>'No Data'];
		}

		unset($payments);

		$query5 = $this->db->query("SELECT
			payments.paymentDate,
			payments.orNo,
			sem.sem,
			sy.sy,
			assessment.feeType,
			paymentdetails.oldParticular,
			particulars.particularName,
			Sum(paymentdetails.amt1) AS amt1,
			Sum(paymentdetails.amt2) AS amt2
			FROM
				payments
			INNER JOIN sem ON payments.semId = sem.semId
			INNER JOIN sy ON payments.syId = sy.syId
			INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
			LEFT JOIN assessment ON assessment.semId = sem.semId AND assessment.syId = sy.syId AND paymentdetails.assessmentId = assessment.assessmentId
			LEFT JOIN particulars ON particulars.semId = sem.semId AND particulars.syId = sy.syId AND paymentdetails.particularId = particulars.particularId
			WHERE
			payments.ssi_id ='{$id}'OR
			payments.acctno = '{$acctno}'
		GROUP BY
			payments.orNo,
			assessment.feeType,
			payments.paymentDate,
			sem.sem,
			sy.sy
		ORDER BY
			sy.sy ASC,
			sem.sem ASC,
			payments.orNo ASC");
		if ($query5->num_rows() > 0)
		{
			foreach ($query5->result() as $row5)
			{
				$part="";
				if(!$row5->oldParticular && !$row5->particularName)
				{
					$part=$row5->feeType;
				}
				else if (!$row5->feeType && !$row5->particularName)
				{
					$part=$row5->oldParticular;
				}
				else if (!$row5->oldParticular && !$row5->feeType)
				{
					$part=$row5->particularName;
				}
				$payments[]=["paymentDate"=>$row5->paymentDate,"amt1"=>$row5->amt1,"amt2"=>$row5->amt2,"orNo"=>$row5->orNo,"sem"=>$row5->sem,"sy"=>$row5->sy,"particular"=>$part];
			}
		}
		else
		{
			$payments[]=["paymentDate"=>'No Data',"amt1"=>'No Data',"amt2"=>'No Data',"orNo"=>'No Data',"sem"=>'No Data',"sy"=>'No Data',"particular"=>'No Data'];
		}

		unset($studload);
		$query3 = $DB2->query("SELECT
			subject_enrolled.ss_id,
			subject_enrolled.ssi_id,
			subject_enrolled_status.`status`
		FROM
			subject_enrolled
		INNER JOIN subject_enrolled_status ON subject_enrolled.ses_id = subject_enrolled_status.ses_id
		WHERE
			subject_enrolled.ssi_id = '{$id}' AND
			(subject_enrolled_status.`status` = 'enrolled' OR
			subject_enrolled_status.`status` = 'add' OR
    subject_enrolled_status.`status` = 'change')AND
      subject_enrolled.sch_year = '{$sy}' AND
      subject_enrolled.semester = '{$sem}'");
		if ($query3->num_rows() > 0)
		{
			foreach ($query3->result() as $row3)
			{
				$ss_id=$row3->ss_id;
				$query4 = $DB3->query("SELECT
					`subject`.subj_code,
					`subject`.subj_name,
					`subject`.lec_unit,
					`subject`.lab_unit,
					sched_subj.sem,
					sched_subj.sy,
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
					sched_subj.ss_id ='{$ss_id}'");
				if ($query4->num_rows() > 0)
				{
					foreach ($query4->result() as $row4)
					{
						$studload[]=["room"=>substr($row4->room_code, 0, 4),"time"=>substr($row4->time_start, 0, 5)."-".substr($row4->time_end, 0, 5),"day"=>$row4->abbreviation,"subj_code"=>$row4->subj_code,"subj_name1"=>$row4->subj_name,"subj_name"=>substr($row4->subj_name, 0, 30),"lec_unit"=>$row4->lec_unit,"lab_unit"=>$row4->lab_unit,"sy"=>$row4->sy,"sem"=>$row4->sem];
					}
				}
				else
				{
					$studload[]=["subj_code"=>'No Data',"subj_name"=>'No Data',"lec_unit"=>'No Data',"lab_unit"=>'No Data'];
				}
				$discreditquery = $DB3->query("SELECT
					`subject`.subj_code,
					`subject`.subj_name,
					`subject`.lec_unit,
					`subject`.lab_unit,
					sched_subj.sem,
					sched_subj.sy
				FROM
					sched_subj
				INNER JOIN `subject` ON sched_subj.subj_id = `subject`.subj_id
				WHERE
					sched_subj.ss_id ='{$ss_id}' AND
					`subject`.subj_name LIKE '%National Service Training Program%'");
				if ($discreditquery->num_rows() > 0)
				{
					foreach ($discreditquery->result() as $dc)
					{
						$discreditt+=1.5;
					}
					$discredit[]=["dc"=>$discreditt];
				}
			}
		}
		else
		{
			$studload[]=["subj_code"=>'No Data',"subj_name"=>'No Data',"lec_unit"=>'No Data',"lab_unit"=>'No Data'];
		}

		$mfname="";
		$mphone_number="";
		$mtelephone_number="";
		$mbirthdate="";
		$moccupation="";
		$mcity_name="";
		$mprovince_name="";
		$ffname="";
		$fphone_number="";
		$ftelephone_number="";
		$fbirthdate="";
		$foccupation="";
		$fcity_name="";
		$fprovince_name="";
		$gfname="";
		$gphone_number="";
		$gtelephone_number="";
		$gbirthdate="";
		$goccupation="";
		$gcity_name="";
		$gprovince_name="";
		$cname="";
		$caddress="";
		$numbernumber="";
		$cnumber="";

		$query6 = $DB2->query("SELECT
			parents.fname AS pfname,
			parents.mname AS pmname,
			parents.lname AS plname,
			phone_numbers.phone_number,
			telephone_numbers.telephone_number,
			parents.birthdate,
			parents.occupation,
			city.city_name,
			prov.province_name,
			relationship.relationship,
			relationship.type_of_rel
		FROM
			stud_per_info
		INNER JOIN stud_sch_info ON stud_sch_info.spi_id = stud_per_info.spi_id
		INNER JOIN parents_student ON parents_student.spi_id = stud_per_info.spi_id
		INNER JOIN parents ON parents_student.parent_id = parents.parent_id
		INNER JOIN relationship ON parents_student.rel_id = relationship.rel_id
		LEFT JOIN parent_phone ON parent_phone.parent_id = parents.parent_id
		LEFT JOIN phone_numbers ON parent_phone.phone_id = phone_numbers.phone_id
		LEFT JOIN parent_telephones ON parent_telephones.parent_id = parents.parent_id
		LEFT JOIN telephone_numbers ON parent_telephones.telephone_id = telephone_numbers.telephone_id
		LEFT JOIN parent_address ON parent_address.parent_id = parents.parent_id
		LEFT JOIN address ON parent_address.add_id = address.add_id
		LEFT JOIN city ON address.city_id = city.city_id
		LEFT JOIN prov ON city.province_id = prov.province_id
		WHERE
			stud_sch_info.ssi_id = '{$id}'");
		if ($query6->num_rows() > 0)
		{
			foreach ($query6->result() as $row6)
			{
				if ($row6->type_of_rel=="parent")
				{
					if ($row6->relationship=="Father")
					{
						$ffname=$row6->pfname." ".$row6->pmname." ".$row6->plname;
						$fphone_number=$row6->phone_number;
						$ftelephone_number=$row6->telephone_number;
						$fbirthdate=$row6->birthdate;
						$foccupation=$row6->occupation;
						$fcity_name=$row6->city_name;
						$fprovince_name=$row6->province_name;
					}
					else
					{
						$mfname=$row6->pfname." ".$row6->pmname." ".$row6->plname;
						$mphone_number=$row6->phone_number;
						$mtelephone_number=$row6->telephone_number;
						$mbirthdate=$row6->birthdate;
						$moccupation=$row6->occupation;
						$mcity_name=$row6->city_name;
						$mprovince_name=$row6->province_name;
					}
				}
				elseif ($row6->type_of_rel=="guardian")
				{
					$gfname=$row6->pfname." ".$row6->pmname." ".$row6->plname;
					$gphone_number=$row6->phone_number;
					$gtelephone_number=$row6->telephone_number;
					$gbirthdate=$row6->birthdate;
					$goccupation=$row6->occupation;
					$gcity_name=$row6->city_name;
					$gprovince_name=$row6->province_name;
				}
			}
		}
		$query7 = $DB2->query("SELECT
        CONCAT(IFNULL(parents.fname,' '),' ',IFNULL(parents.mname,' '),' ',IFNULL(parents.lname,' ')) AS `name`,
        CONCAT(IFNULL(address.street,' '),' ',IFNULL(brgy.brgy_name,' '),' ',IFNULL(city.city_name,' ')) AS `address`,
        CONCAT(IFNULL(phone_numbers.phone_number,' '),IFNULL(telephone_numbers.telephone_number,' ')) AS `number`
      FROM
        stud_per_info
      INNER JOIN stud_sch_info ON stud_sch_info.spi_id = stud_per_info.spi_id
      INNER JOIN parents_student ON parents_student.spi_id = stud_per_info.spi_id
      INNER JOIN parents ON parents_student.parent_id = parents.parent_id
      INNER JOIN relationship ON parents_student.rel_id = relationship.rel_id
      LEFT JOIN parent_phone ON parent_phone.parent_id = parents.parent_id
      LEFT JOIN phone_numbers ON parent_phone.phone_id = phone_numbers.phone_id
      LEFT JOIN parent_telephones ON parent_telephones.parent_id = parents.parent_id
      LEFT JOIN telephone_numbers ON parent_telephones.telephone_id = telephone_numbers.telephone_id
      LEFT JOIN parent_address ON parent_address.parent_id = parents.parent_id
      LEFT JOIN address ON parent_address.add_id = address.add_id
      LEFT JOIN city ON address.city_id = city.city_id
      LEFT JOIN prov ON address.brgy_id = prov.province_id
      LEFT JOIN brgy ON brgy.city_id = brgy.brgy_id
      WHERE
        stud_sch_info.ssi_id = '{$id}' AND
        relationship.type_of_rel = 'guardian'");
		if ($query7->num_rows() > 0)
		{
			foreach ($query7->result() as $row7)
			{
				$cname=$row7->name;
				$caddress=$row7->address;
				$cnumber=$row7->number;
			}
		}
    $efsm_id="";
    $query8 = $DB2->query("SELECT
      efs_student_modes.efsm_id
    FROM
      stud_sch_info
    INNER JOIN efs_student_modes ON efs_student_modes.ssi_id = stud_sch_info.ssi_id
    INNER JOIN efs_classifications ON efs_student_modes.efc_id = efs_classifications.efc_id
    INNER JOIN enrollment_flow_sources ON efs_classifications.ef_id = enrollment_flow_sources.ef_id
    WHERE
    enrollment_flow_sources.location LIKE '%Accounting%' AND
      stud_sch_info.ssi_id = '{$id}' AND
      efs_student_modes.sch_year = '{$sy}' AND
      efs_student_modes.semester = '{$sem}'");
		if ($query8->num_rows() > 0)
		{
			foreach ($query8->result() as $row8)
			{
				$efsm_id=$row8->efsm_id;

			}
		}

		$query1 = $DB2->query("SELECT
      stud_sch_info.ssi_id,
      stud_per_info.lname,
      stud_per_info.fname,
      stud_per_info.mname,
      stud_sch_info.acct_no,
      stud_sch_info.usn_no,
      stud_sch_info.stud_id,
      stud_per_info.birthdate,
      stud_per_info.birthplace,
      stud_per_info.gender,
      `year`.`year`,
      CONCAT(IFNULL(address.street,' '),IFNULL(brgy.brgy_name,' '),IFNULL(city.city_name,' ')) AS `street`,
      stud_per_info.weight,
      stud_per_info.height,
      citizenship.nationality,
      prov.province_name,
      city.city_name,
      stud_per_info.civ_status,
      phone_numbers.phone_number,
      program_list.prog_abv,
      `year`.is_graduating
    FROM
      stud_per_info
    INNER JOIN stud_sch_info ON stud_sch_info.spi_id = stud_per_info.spi_id
    LEFT JOIN `year` ON `year`.ssi_id = stud_sch_info.ssi_id
    LEFT JOIN s_main_address ON s_main_address.spi_id = stud_per_info.spi_id
    LEFT JOIN address ON s_main_address.add_id = address.add_id
    LEFT JOIN citizenship ON stud_per_info.cit_id = citizenship.cit_id
    LEFT JOIN city ON address.city_id = city.city_id
    LEFT JOIN prov ON address.province_id = prov.province_id
    LEFT JOIN student_phone ON student_phone.spi_id = stud_per_info.spi_id
    LEFT JOIN phone_numbers ON student_phone.phone_id = phone_numbers.phone_id
    LEFT JOIN stud_prog_taken ON stud_prog_taken.ssi_id = stud_sch_info.ssi_id
    LEFT JOIN program_list ON stud_prog_taken.pl_id = program_list.pl_id
    LEFT JOIN brgy ON address.brgy_id = brgy.brgy_id
		WHERE
			stud_sch_info.ssi_id = '{$id}'
		LIMIT 1");
		if ($query1->num_rows() > 0)
		{
			foreach ($query1->result() as $row1)
			{
				$acctno=$row1->acct_no;
				$oldacc=$this->checkoldsys($acctno);

				$data[]=["is_graduating"=>$row1->is_graduating,"cnumber"=>$cnumber,"caddress"=>$caddress,"cname"=>$cname,"gfname"=>$gfname,"gphone_number"=>$gphone_number,"gtelephone_number"=>$gtelephone_number,"gbirthdate"=>$gbirthdate,"goccupation"=>$goccupation,"gcity_name"=>$gcity_name,"gprovince_name"=>$gprovince_name,"ffname"=>$ffname,"fphone_number"=>$fphone_number,"ftelephone_number"=>$ftelephone_number,"fbirthdate"=>$fbirthdate,"foccupation"=>$foccupation,"fcity_name"=>$fcity_name,"fprovince_name"=>$fprovince_name,"mfname"=>$mfname,"mphone_number"=>$mphone_number,"mtelephone_number"=>$mtelephone_number,"mbirthdate"=>$mbirthdate,"moccupation"=>$moccupation,"mcity_name"=>$mcity_name,"mprovince_name"=>$mprovince_name,"weight"=>$row1->weight,"height"=>$row1->height,"nationality"=>$row1->nationality,"province_name"=>$row1->province_name,"city_name"=>$row1->city_name,"civ_status"=>$row1->civ_status,"phone_number"=>$row1->phone_number,"street"=>$row1->street,"year"=>$row1->year,"birthdate"=>$row1->birthdate,"birthplace"=>$row1->birthplace,"gender"=>$row1->gender,"lname"=>$row1->lname,"fname"=>$row1->fname,"mname"=>$row1->mname,"acct_no"=>$row1->acct_no,"ssi_id"=>$row1->ssi_id,"usn_no"=>$row1->usn_no,"course"=>$row1->prog_abv,"stud_id"=>$row1->stud_id,"sy_sem_enrolled"=>$enrolled,"studload"=>$studload,"payments"=>$payments,"status"=>$status,"discredit"=>$discredit,"efsm_id"=>$efsm_id];
			}
		}
		else
		{
			$data[]=["is_graduating"=>'No Data',"cnumber"=>'No Data',"caddress"=>'No Data',"cname"=>'No Data',"gfname"=>'No Data',"gphone_number"=>'No Data',"gtelephone_number"=>'No Data',"gbirthdate"=>'No Data',"goccupation"=>'No Data',"gcity_name"=>'No Data',"gprovince_name"=>'No Data',"ffname"=>'No Data',"fphone_number"=>'No Data',"ftelephone_number"=>'No Data',"fbirthdate"=>'No Data',"foccupation"=>'No Data',"fcity_name"=>'No Data',"fprovince_name"=>'No Data',"mfname"=>'No Data',"mphone_number"=>'No Data',"mtelephone_number"=>'No Data',"mbirthdate"=>'No Data',"moccupation"=>'No Data',"mcity_name"=>'No Data',"mprovince_name"=>'No Data',"weight"=>'No Data',"height"=>'No Data',"nationality"=>'No Data',"province_name"=>'No Data',"city_name"=>'No Data',"civ_status"=>'No Data',"phone_number"=>'No Data',"street"=>'No Data',"year"=>'No Data',"birthdate"=>'No Data',"birthplace"=>'No Data',"gender"=>'No Data',"lname"=>$row1->lname,"fname"=>$row1->fname,"mname"=>$row1->mname,"acct_no"=>'No Data',"ssi_id"=>'No Data',"usn_no"=>'No Data',"course"=>'No Data',"stud_id"=>'No Data',"sy_sem_enrolled"=>$enrolled,"studload"=>$studload,"payments"=>$payments,"status"=>$status,"discredit"=>$discredit,"efsm_id"=>""];
		}


		return json_encode($data);
	}
	// get balance old
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
				enrolled.acctno = '{$acctno}'
			ORDER BY
				enrolled.sy ASC,
				enrolled.sem ASC");
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
						Sum(tbl_assessment_copy.amt) as `amt`
					FROM
						tbl_assessment_copy
					WHERE
						tbl_assessment_copy.acctno = '{$acctno}' AND
						tbl_assessment_copy.sy = '{$sy}' AND
						tbl_assessment_copy.sem = '{$sem}'"
				);
				//discount
				$discount=$this->getamt("SELECT
						Sum(tbl_discount2.amt) as `amt`
					FROM
						tbl_discount2
					WHERE
						tbl_discount2.acctno = '{$acctno}' AND
						tbl_discount2.sy = '{$sy}' AND
						tbl_discount2.sem = '{$sem}'"
				);
				//payment
				$payment=$this->getamt("SELECT
						Sum(payment.Amt) AS `amt`
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

				if($balance>0.4 || $bridgtotal>0.4 || $tutortotal>0.4)
				{
					$p1=$this->getpayment($acctno,"assessment",$sy,$sem);
					$p2=$this->getpayment($acctno,"bridging",$sy,$sem);
					$p3=$this->getpayment($acctno,"tutorial",$sy,$sem);
					$balance=$balance-$p1;
					$bridgtotal=$bridgtotal-$p2;
					$tutortotal=$tutortotal-$p3;
					if($balance>0.4 || $bridgtotal>0.4 || $tutortotal>0.4)
					{
						$data[]=["sy"=>$sy,"sem"=>$sem,"ass"=>$this->checkneg($balance),"bridg"=>$this->checkneg($bridgtotal),"tutorial"=>$this->checkneg($tutortotal)];
					}

				}
			}
		}
		return json_encode($data);
	}
  //get old balance for accountslip
	function checkoldsys2($acctno)
	{
		$DB4 = $this->load->database('db4', TRUE);
		$data=0;
		$balance=0;
		$assesstotal=0;
		$discount=0;
		$payment=0;
		$p1=0;
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
				enrolled.sy ASC,
				enrolled.sem ASC");
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
						Sum(tbl_assessment_copy.amt) as `amt`
					FROM
						tbl_assessment_copy
					WHERE
						tbl_assessment_copy.acctno = '{$acctno}' AND
						tbl_assessment_copy.sy = '{$sy}' AND
						tbl_assessment_copy.sem = '{$sem}'"
				);
				//discount
				$discount=$this->getamt("SELECT
						Sum(tbl_discount2.amt) as `amt`
					FROM
						tbl_discount2
					WHERE
						tbl_discount2.acctno = '{$acctno}' AND
						tbl_discount2.sy = '{$sy}' AND
						tbl_discount2.sem = '{$sem}'"
				);
				//payment
				$payment=$this->getamt("SELECT
						Sum(payment.Amt) AS `amt`
					FROM
						payment
					WHERE
						payment.acctno = '{$acctno}' AND
						payment.SY = '{$sy}' AND
						payment.SEM = '{$sem}' AND
						payment.`MODE` = 'cash'"
				);
				$balance+=$assesstotal-$discount-$payment;
				$p1+=$this->getpayment($acctno,"assessment",$sy,$sem);


			}
			if($balance>0.4)
			{
				$balance=$balance-$p1;
				if($balance>0.4)
				{
					$data=$balance;
				}
			}
		}
		return $data;
	}
  //for accountslip bridg balance
  function checkoldsys3($acctno)
	{
		$DB4 = $this->load->database('db4', TRUE);
		$data=0;
		$bridgtotal=0;
		$bridgpayment=0;
		$p2=0;
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
				enrolled.sy ASC,
				enrolled.sem ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$course=$row->course;
				$sem=$row->sem;
				$sy=$row->sy;
				$status=$row->status;
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
					$bridgtotal+=$bridgtotal-$bridgpayment;
				}
				$p2+=$this->getpayment($acctno,"bridging",$sy,$sem);
			}
			if($bridgtotal>0.4)
			{
				$bridgtotal=$bridgtotal-$p2;
				if($bridgtotal>0.4)
				{
					$data=$bridgtotal;
				}
			}
		}
		return $data;
	}
  //for accountslip tutorial balance
  function checkoldsys4($acctno)
	{
		$DB4 = $this->load->database('db4', TRUE);
		$data=0;
		$tutortotal=0;
		$p3=0;
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
				enrolled.sy ASC,
				enrolled.sem ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$course=$row->course;
				$sem=$row->sem;
				$sy=$row->sy;
				$status=$row->status;
				$tutortotal+=$this->gettutorial($sy,$sem,$course,$status,$acctno);
				$p3+=$this->getpayment($acctno,"tutorial",$sy,$sem);
			}
			if($tutortotal>0.4)
			{
				$tutortotal=$tutortotal-$p3;
				if($tutortotal>0.4)
				{
					$data=$tutortotal;
				}
			}
		}
		return $data;
	}
	//payment old
	function getpayment($acctno,$stat,$sy,$sem)
	{
		$query="";
		$num=0;
		if ($stat=="assessment")
		{
			$query = $this->db->query("SELECT
				Sum(paymentdetails.amt2) AS `amt`
			FROM
				payments
			INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
			INNER JOIN sy ON payments.syId = sy.syId
			INNER JOIN sem ON payments.semId = sem.semId
			WHERE
				payments.acctno = '{$acctno}' AND
				(paymentdetails.oldParticular <> 'bridging' AND
				paymentdetails.oldParticular <> 'tutorial') AND
				sy.sy = '{$sy}' AND
				sem.sem = '{$sem}'");
		}
		elseif ($stat=="bridging")
		{
			$query = $this->db->query("SELECT
				Sum(paymentdetails.amt2) AS `amt`
			FROM
				payments
			INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
			INNER JOIN sy ON payments.syId = sy.syId
			INNER JOIN sem ON payments.semId = sem.semId
			WHERE
				payments.acctno = '{$acctno}' AND
				paymentdetails.oldParticular = 'bridging' AND
				sy.sy = '{$sy}' AND
				sem.sem = '{$sem}'");
		}
		elseif ($stat=="tutorial")
		{
			$query = $this->db->query("SELECT
				Sum(paymentdetails.amt2) AS `amt`
			FROM
				payments
			INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
			INNER JOIN sy ON payments.syId = sy.syId
			INNER JOIN sem ON payments.semId = sem.semId
			WHERE
				payments.acctno = '{$acctno}' AND
				paymentdetails.oldParticular = 'tutorial'AND
				sy.sy = '{$sy}' AND
				sem.sem = '{$sem}'");
		}
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$num+=$row->amt;
			}
		}
		return $num;
	}
	function checkneg($num)
	{
		if ($num < 0.5)
		{
			$num=0;
		}
		return $num;
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
				$amt=($tpu*$nou*($rnoe-$noe))/$noe;
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
  // generate assessment
	function assess($id,$sy,$sem,$stat,$course,$totalunit,$labunit,$graduating)
	{
		$DB2 = $this->load->database('db2', TRUE);
		$DB3 = $this->load->database('db3', TRUE);
		$perunitamt1=0;
		$perunitamt2=0;
		$tuition1=0;
		$tuition2=0;
		$bridg1=0;
		$bridg2=0;
		$totur1=0;
		$totur2=0;
		$totallab=0;
		$syid;
		$semid;
		$courseType;
		$data=array();
		$totalass1=0;
		$totalass2=0;
		$collectionReportGroup="";
		//tuition
		$perunit = $this->db->query("SELECT
			particulars.amt1,
			particulars.amt2,
			sy.syId,
			sem.semId,
			particulars.courseType,
			particulars.collectionReportGroup
		FROM
			particulars
		INNER JOIN sy ON particulars.syId = sy.syId
		INNER JOIN sem ON particulars.semId = sem.semId
		WHERE
			particulars.particularName = '{$course}' AND
			particulars.studentStatus = '{$stat}' AND
			sy.sy = '{$sy}' AND
			sem.sem = '{$sem}'");
		if ($perunit->num_rows() > 0)
		{
			foreach ($perunit->result() as $row)
			{
				$perunitamt1=$row->amt1;
				$perunitamt2=$row->amt2;
				$syid=$row->syId;
				$semid=$row->semId;
				$courseType=$row->courseType;
				$collectionReportGroup=$row->collectionReportGroup;
			}
		}
		if ($courseType=="3") {
			$highsector="";
			$highsectorquery = $DB2->query("SELECT
				hschool_student.sector
			FROM
				stud_sch_info
			INNER JOIN stud_per_info ON stud_sch_info.spi_id = stud_per_info.spi_id
			INNER JOIN hschool_student ON hschool_student.spi_id = stud_per_info.spi_id
			WHERE
				stud_sch_info.ssi_id ='{$id}'");
			if ($highsectorquery->num_rows() > 0)
			{
				foreach ($highsectorquery->result() as $row)
				{
					$highsector=$row->sector;
				}
			}
			if ($highsector=="private")
			{
				//tuition
				$tuition1="16000";
				$tuition2="4000";
				$this->insertpar($id,"Tuition(DEPED)",$tuition1,$tuition1,"Tuition",$semid,$syid,"shs");
				$this->insertpar($id,"Tuition",$tuition2,$tuition2,"Tuition",$semid,$syid,$collectionReportGroup);


			}
			else if ($highsector=="public")
			{
				//tuition
				$tuition1="20000";
				$tuition2="0";
				$this->insertpar($id,"Tuition(DEPED)",$tuition1,$tuition1,"Tuition",$semid,$syid,"shs");
				$this->insertpar($id,"Tuition",$tuition2,$tuition2,"Tuition",$semid,$syid,$collectionReportGroup);
			}
			$misc = $this->db->query("SELECT
				particulars.amt1,
				particulars.amt2,
				particulars.particularName,
				particulars.collectionReportGroup
			FROM
				particulars
			INNER JOIN sy ON particulars.syId = sy.syId
			INNER JOIN sem ON particulars.semId = sem.semId
			WHERE
				(particulars.feeType = 'Miscellaneous' OR
        particulars.feeType = 'Other Fee') AND
				particulars.studentStatus = '{$stat}' AND
				sy.sy = '{$sy}' AND
				sem.sem = '{$sem}' AND
				particulars.courseType = '{$courseType}'");
			if ($misc->num_rows() > 0)
			{
				foreach ($misc->result() as $row1)
				{
					$totalass1+=$row1->amt1;
					$totalass2+=$row1->amt2;
					$this->insertpar($id,$row1->particularName,$row1->amt1,$row1->amt2,"Miscellaneous",$semid,$syid,$collectionReportGroup);
				}
			}

		}else{
			$tuition1=$perunitamt1*$totalunit;
			$tuition2=$perunitamt2*$totalunit;
			$totalass1+=$tuition1;
			$totalass2+=$tuition2;
			$this->insertpar($id,"Tuition",$tuition1,$tuition2,"Tuition",$semid,$syid,$collectionReportGroup);
			//misc
			$misc = $this->db->query("SELECT
				particulars.amt1,
				particulars.amt2,
				particulars.particularName,
				particulars.feeType,
				particulars.collectionReportGroup
			FROM
				particulars
			INNER JOIN sy ON particulars.syId = sy.syId
			INNER JOIN sem ON particulars.semId = sem.semId
			WHERE
				particulars.studentStatus = '{$stat}' AND
				sy.sy = '{$sy}' AND
				sem.sem = '{$sem}' AND
				particulars.courseType = '{$courseType}' AND
        (particulars.feeType = 'Miscellaneous' OR
        particulars.feeType = 'Other Fee')");
			if ($misc->num_rows() > 0)
			{
				foreach ($misc->result() as $row1)
				{
					$totalass1+=$row1->amt1;
					$totalass2+=$row1->amt2;
					$this->insertpar($id,$row1->particularName,$row1->amt1,$row1->amt2,$row1->feeType,$semid,$syid,$row1->collectionReportGroup);
				}
			}

			//lab subject
			$lab1=0;
			$lab2=0;
			$data2=array();
			$lab = $this->db->query("SELECT
				particulars.amt1,
				particulars.amt2,
				particulars.particularName,
				collectionReportGroup,
				particulars.collectionReportGroup
			FROM
				particulars
			INNER JOIN sy ON particulars.syId = sy.syId
			INNER JOIN sem ON particulars.semId = sem.semId
			WHERE
				particulars.feeType = 'Laboratory' AND
				particulars.studentStatus = '{$stat}' AND
				sy.sy = '{$sy}' AND
				sem.sem = '{$sem}' AND
				particulars.courseType = '{$courseType}'");
			if ($lab->num_rows() > 0)
			{
				foreach ($lab->result() as $row3)
				{
					$labfee1=0;
					$labfee2=0;
					$labname="";
					$query4 = $DB2->query("SELECT
            subject_enrolled.ss_id,
            subject_enrolled_status.`status`
          FROM
            subject_enrolled
          INNER JOIN subject_enrolled_status ON subject_enrolled.ses_id = subject_enrolled_status.ses_id
          WHERE (subject_enrolled_status.`status` = 'enrolled' OR
            subject_enrolled_status.`status` = 'add' OR
            subject_enrolled_status.`status` = 'change') AND
						subject_enrolled.ssi_id ='{$id}'");
					if ($query4->num_rows() > 0)
					{
						foreach ($query4->result() as $row4)
						{
							$ss_id=$row4->ss_id;

							$query4 = $DB3->query("SELECT
							`subject`.lab_unit,
							lab_type.`description`,
              `subject`.subj_name
							FROM
								sched_subj
							INNER JOIN `subject` ON sched_subj.subj_id = `subject`.subj_id
							INNER JOIN lab_type ON `subject`.lab_type_id = lab_type.lab_type_id
							WHERE
								sched_subj.ss_id = '{$ss_id}' AND
								lab_type.`name` = '{$row3->particularName}'");
							if ($query4->num_rows() > 0)
							{
								foreach ($query4->result() as $row4)
								{
									$labfee1=$row3->amt1*$row4->lab_unit;
									$labfee2=$row3->amt2*$row4->lab_unit;
									$labname=$row4->description;
                  $subj_namen=$row4->subj_name;
									$lab1+=$labfee1;
									$lab2+=$labfee2;
								}
							}
						}
					}
          $this->db->delete('assessment', array('ssi_id' => $id,'syid' => $syid,'semId' => $semid,'feeType' => 'Laboratory'));
					if ($labname!="") {
						$this->insertpar($id,$row3->particularName,$lab1,$lab2,"Laboratory",$semid,$syid,$row3->collectionReportGroup);
					}

				}

			}
			$totalass1+=$lab1;
			$totalass2+=$lab2;

			// if ($stat=="new")
			// {
			// 	$newstud1=$tuition1*0.30;
			// 	$newstud2=$tuition2*0.30;
			// 	$firstyr = $this->db->query("SELECT
			// 		discountId
			// 	FROM
			// 		discount
			// 	INNER JOIN sem ON discount.semId = sem.semId
			// 	INNER JOIN sy ON discount.syId = sy.syId
			// 	WHERE
			// 		sy.sy = '{$sy}' AND
			// 		sem.sem = '{$sem}' AND
			// 		discount.ssi_id = '{$id}' AND
			// 		discount.discountDesc = '1st Year'");
			// 	if ($firstyr->num_rows() > 0)
			// 	{
			// 		foreach ($firstyr->result() as $row)
			// 		{
			// 			$discountId=$row->discountId;
			// 			$data2 = array(
			// 				'amt1' => $newstud1,
			// 				'amt2' => $newstud2
			// 			);
			// 			$this->db->where(array('semId' => $semid,'syId' => $syid,'discountDesc' =>'1st Year','discountId' => $discountId));
			// 			$this->db->update('discount', $data2);
			// 		}
			// 	}
			// 	else
			// 	{
			// 		$arr['ssi_id']=$id;
			// 		$arr['discountDesc']="1st Year";
			// 		$arr['amt1']=$newstud1;
			// 		$arr['amt2']=$newstud2;
			// 		$arr['semId']=$semid;
			// 		$arr['syId']=$syid;
			// 		return $this->db->insert('discount',$arr);
			// 	}
			// }
			// else
			// {
			// 	return $this->db->delete('discount', array('ssi_id' => $id, 'syId'=>$sy, 'semId'=>$sem, 'discountDesc'=>'1st Year'));
			// }

			$query5 = $this->db->query("SELECT
				discount.amt1,
				discount.amt2
			FROM
				discount
			WHERE
				discount.ssi_id = '{$id}' AND
				discount.semId = '{$semid}' AND
				discount.syId = '{$syid}' AND
				discount.discountDesc = 'Full Payment'");
			if ($query5->num_rows() == 0)
			{
				$fyr1=0;
				$fyr2=0;
				$firstyr = $this->db->query("SELECT
					discount.amt1,
					discount.amt2
				FROM
					discount
				INNER JOIN sem ON discount.semId = sem.semId
				INNER JOIN sy ON discount.syId = sy.syId
				WHERE
					sy.sy = '{$sy}' AND
					sem.sem = '{$sem}' AND
					discount.ssi_id = '{$id}' AND
					discount.discountDesc = '1st Year'");
				if ($firstyr->num_rows() > 0)
				{
					foreach ($firstyr->result() as $row)
					{
						$fyr1=$row->amt1;
						$fyr2=$row->amt2;
					}
				}
				$othersfee1=($totalass1-$fyr1)*(6/100);
				$othersfee2=($totalass2-$fyr2)*(6/100);
				$this->insertpar($id,"Handling Fee",$othersfee1,$othersfee2,"Handling Fee",$semid,$syid,"others");
			}
			else
			{
				$this->db->delete('assessment', array('ssi_id' => $id,'syid' => $syid,'semId' => $semid,'particular' => 'Handling Fee'));
			}
		}
		//bridging & tutorial
		$subjectload = $DB2->query("SELECT
		subject_enrolled.ss_id
		FROM
			subject_enrolled
		WHERE
			subject_enrolled.ssi_id ='{$id}'");
		if ($subjectload->num_rows() > 0)
		{
			foreach ($subjectload->result() as $row)
			{
				$ss_id=$row->ss_id;

				$bridgingquery = $DB3->query("SELECT
					`subject`.subj_name,
					subject_declaration.declaration,
					(`subject`.lec_unit+`subject`.lab_unit) AS unit
				FROM
					subject_declaration
				INNER JOIN sched_subj ON subject_declaration.ss_id = sched_subj.ss_id
				INNER JOIN `subject` ON sched_subj.subj_id = `subject`.subj_id
				WHERE
					subject_declaration.ss_id = '{$ss_id}'");
				if ($bridgingquery->num_rows() > 0)
				{

					foreach ($bridgingquery->result() as $row1)
					{
						if ($row1->declaration=="bridge") {
							$bridg1=$perunitamt1*$row1->unit;
							$bridg2=$perunitamt2*$row1->unit;
							$this->insertpar($id,$row1->subj_name,$bridg1,$bridg2,"Bridging",$semid,$syid,"others");
						}
						else
						{
							$query = $DB2->query("SELECT * FROM `subject_enrolled` WHERE `ss_id` ='{$ss_id}'");
							$noe = $query->num_rows();
							$tutor1=($perunitamt1*$row1->unit)*(15-$noe)/$noe;
							$tutor2=($perunitamt2*$row1->unit)*(15-$noe)/$noe;
							$this->insertpar($id,$row1->subj_name,$tutor1,$tutor2,"Tutorial",$semid,$syid,"others");
						}
					}
				}
			}
		}
		return json_encode($data);

	}
  // insert particular to assessment
	function insertpar($ssi_id,$particular,$amt1,$amt2,$feeType,$semId,$syId,$collectionReportGroup)
	{
		$query = $this->db->query("SELECT
		assessment.assessmentId
		FROM `assessment`
		WHERE
		assessment.particular = '{$particular}' AND
		assessment.ssi_id = '{$ssi_id}' AND
		assessment.semId = '{$semId}' AND
		assessment.syId = '{$syId}' AND
		assessment.feeType = '{$feeType}'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$assessmentId=$row->assessmentId;
				$data = array(
					'amt1' => $amt1,
					'amt2' => $amt2,
					'collectionReportGroup' => $collectionReportGroup
				);
				$this->db->where('assessmentId', $assessmentId);
				$this->db->update('assessment', $data);
			}
		}else{
			$arr['ssi_id']=$ssi_id;
			$arr['particular']=$particular;
			$arr['amt1']=$amt1;
			$arr['amt2']=$amt2;
			$arr['feeType']=$feeType;
			$arr['semId']=$semId;
			$arr['syId']=$syId;
			$arr['collectionReportGroup']=$collectionReportGroup;
			return $this->db->insert('assessment',$arr);
		}

	}
  // display assessment
	function loadassess($id,$sy,$sem)
	{
		$data2=array();
		$assess=array();
		$discount=array();
		$payments=array();
		$query = $this->db->query("SELECT
			assessment.assessmentId,
			assessment.ssi_id,
			assessment.particular,
			assessment.amt1,
			assessment.amt2,
			assessment.feeType,
			assessment.semId,
			assessment.syId
		FROM
			assessment
		INNER JOIN sy ON assessment.syId = sy.syId
		INNER JOIN sem ON assessment.semId = sem.semId
		WHERE
			assessment.ssi_id = '{$id}' AND
			sy.sy = '{$sy}' AND
			sem.sem = '{$sem}'
		ORDER BY particular ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$assess[]=["assessmentId"=>$row->assessmentId,"ssi_id"=>$row->ssi_id,"particular"=>$row->particular,"amt1"=>$row->amt1,"amt2"=>$row->amt2,"feeType"=>$row->feeType,"semId"=>$row->semId,"syId"=>$row->syId];
			}
		}else{
			$assess[]=["assessmentId"=>"No data","ssi_id"=>"No data","particular"=>"No data","amt1"=>"No data","amt2"=>"No data","feeType"=>"No data","semId"=>"No data","syId"=>"No data"];
		}

		$query1 = $this->db->query("SELECT
			discount.discountDesc,
			discount.amt1,
			discount.amt2
		FROM
			discount
		INNER JOIN sem ON discount.semId = sem.semId
		INNER JOIN sy ON discount.syId = sy.syId
		WHERE
			discount.ssi_id = '{$id}' AND
			sem.sem = '{$sem}' AND
			sy.sy = '{$sy}'");
		if ($query1->num_rows() > 0)
		{
			foreach ($query1->result() as $row1)
			{
				$discount[]=["discountName"=>$row1->discountDesc,"amt1"=>$row1->amt1,"amt2"=>$row1->amt2];
			}
		}else{
			$discount[]=["discountName"=>"No data","amt1"=>"No data","amt2"=>"No data"];
		}

		$query2 = $this->db->query("SELECT DISTINCT
			payments.orNo,
			payments.paymentDate,
			payments.amt1,
			payments.amt2
		FROM
			payments
		INNER JOIN sem ON payments.semId = sem.semId
		INNER JOIN sy ON payments.syId = sy.syId
		INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
		INNER JOIN assessment ON assessment.semId = sem.semId AND assessment.syId = sy.syId AND paymentdetails.assessmentId = assessment.assessmentId
		WHERE
			payments.ssi_id = '{$id}' AND
			sem.sem = '{$sem}' AND
			sy.sy = '{$sy}'
		");
		if ($query2->num_rows() > 0)
		{
			foreach ($query2->result() as $row2)
			{
				$payments[]=["or"=>$row2->orNo,"date"=>$row2->paymentDate,"amt1"=>$row2->amt1,"amt2"=>$row2->amt2];
			}
		}else{
			$payments[]=["or"=>"No data","date"=>"No data","amt1"=>"No data","amt2"=>"No data"];
		}

		$data2[]=["assess"=>$assess,"discount"=>$discount,"payments"=>$payments,"oldaccount"=>$this->oldaccount($id,$sy,$sem)];
		return json_encode($data2);
	}
  // generate old account new system
	function oldaccount($id,$sy,$sem)
	{
		$oldaccount=array();
		$assess1=0;
		$assess2=0;
		$discount1=0;
		$discount2=0;
		$payments1=0;
		$payments2=0;
		$query = $this->db->query("SELECT
			SUM(assessment.amt1) AS amt1,
			SUM(assessment.amt2) AS amt2
		FROM
			assessment
		INNER JOIN sy ON assessment.syId = sy.syId
		INNER JOIN sem ON assessment.semId = sem.semId
		WHERE
			assessment.ssi_id = '{$id}' AND
			(sy.sy <> '{$sy}' OR
			sem.sem <> '{$sem}')");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$assess1=$row->amt1;
				$assess2=$row->amt2;
			}
		}

		$query1 = $this->db->query("SELECT
			SUM(discount.amt1) AS amt1,
			SUM(discount.amt2) AS amt2
		FROM
			discount
		INNER JOIN sem ON discount.semId = sem.semId
		INNER JOIN sy ON discount.syId = sy.syId
		WHERE
			discount.ssi_id = '{$id}' AND
			(sem.sem <> '{$sem}' OR
			sy.sy <> '{$sy}')");
		if ($query1->num_rows() > 0)
		{
			foreach ($query1->result() as $row1)
			{
				$discount1=$row1->amt1;
				$discount2=$row1->amt2;
			}
		}

		$query2 = $this->db->query("SELECT DISTINCT
			Sum(paymentdetails.amt1) AS amt1,
			Sum(paymentdetails.amt2) AS amt2
		FROM
			payments
		INNER JOIN sem ON payments.semId = sem.semId
		INNER JOIN sy ON payments.syId = sy.syId
		INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
		INNER JOIN assessment ON paymentdetails.assessmentId = assessment.assessmentId
		WHERE
			payments.ssi_id = '{$id}' AND
			(sem.sem <> '{$sem}' OR
			sy.sy <> '{$sy}')");
		if ($query2->num_rows() > 0)
		{
			foreach ($query2->result() as $row2)
			{
				$payments1=$row2->amt1;
				$payments2=$row2->amt2;
			}
		}
		$total1=$assess1-$discount1-$payments1;
		$total2=$assess2-$discount2-$payments2;
		$oldaccount[]=["oldacc1"=>$total1,"oldacc2"=>$total2];
		return $oldaccount;
	}
  // generate tuition new
	function getStudentTuition($id,$sy,$sem)
	{
		$data=array();
		$tui1=0;
		$tui2=0;
		$ass1=0;
		$ass2=0;
		$dis1=0;
		$dis2=0;
		$query = $this->db->query("SELECT
			assessment.particular,
			assessment.amt1,
			assessment.amt2
		FROM
			assessment
		INNER JOIN sy ON assessment.syId = sy.syId
		INNER JOIN sem ON assessment.semId = sem.semId
		WHERE
			assessment.ssi_id = '{$id}' AND
			sy.sy = '{$sy}' AND
			sem.sem = '{$sem}' AND
			assessment.particular != 'Handling Fee'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				if ($row->particular=="Tuition") {
					$tui1=$row->amt1;
					$tui2=$row->amt2;
				}
					$ass1+=$row->amt1;
					$ass2+=$row->amt2;

			}
		}
		$query2 = $this->db->query("SELECT
			discount.amt1,
			discount.amt2
		FROM
			discount
		INNER JOIN sem ON discount.semId = sem.semId
		INNER JOIN sy ON discount.syId = sy.syId
		WHERE
			discount.ssi_id = '{$id}' AND
			sem.sem = '{$sem}' AND
			sy.sy = '{$sy}' AND
			discount.discountDesc = '1st Year'");
		if ($query2->num_rows() > 0)
		{
			foreach ($query2->result() as $row1)
			{
				$dis1=$row1->amt1;
				$dis2=$row1->amt2;
			}
		}
		$tass1=$ass1-$dis1;
		$tass2=$ass2-$dis2;

		$data[]=['amt1'=>$tui1,'amt2'=>$tui2,'ass1'=>$tass1,'ass2'=>$tass2,];
		return json_encode($data);
	}
  // fetch users
	function getusers()
  {
	  $query = $this->db->query("SELECT
      users.username,
      users.password,
      users.userRole,
      users.userStatus,
      users.userId
	   FROM users")->result();
     return $query;
	}
  // fetch fee sched
	function getsched()
  {
    $query = $this->db->query("SELECT
      fee_schedule.feeSchedId,
      fee_schedule.`month`,
      fee_schedule.`year`,
      fee_schedule.percent,
      fee_schedule.label,
      fee_schedule.semId,
      fee_schedule.syId,
      sem.sem,
      sy.sy
    FROM
      fee_schedule
    INNER JOIN sem ON fee_schedule.semId = sem.semId
    INNER JOIN sy ON fee_schedule.syId = sy.syId")->result();

    return $query;
	}
  // transfer colectin report old to new
  function transfercollection($month,$year)
  {
    $DB4 = $this->load->database('db4', TRUE);
    $data=array();
    $query = $DB4->query("SELECT
      collection_report1.acctno,
      collection_report1.pdate,
      collection_report1.`OR`,
      CONCAT(students.last,', ',students.`first`) AS `name`,
      IFNULL(Tuition_Fee,0) AS `Tuition_Fee`,
      IFNULL(Lab_Fee,0) AS `Lab_Fee`,
      IFNULL(Internet_Fee,0) AS `Internet_Fee`,
      IFNULL(Office365,0) AS `Office365`,
      IFNULL(Miscellaneous,0) AS `Miscellaneous`,
      IFNULL(Networking,0) AS `Networking`,
      IFNULL(Physics,0) AS `Physics`,
      IFNULL(STCAB1,0) AS `STCAB1`,
      IFNULL(Special_Exam_50P1,0) AS `Special_Exam_50P1`,
      IFNULL(Others1,0) AS `Others1`,
      IFNULL(Others,0) AS `Others`,
      IFNULL(Merchandise,0) AS `Merchandise`,
      IFNULL(SC,0) AS `SC`,
      IFNULL(Newsletter,0) AS `Newsletter`,
      IFNULL(Special_Exam_50P2,0) AS `Special_Exam_50P2`,
      IFNULL(Others2,0) AS `Others2`,
      IFNULL(Ncc_uk,0) AS `Ncc_uk`,
      IFNULL(MS_Fee,0) AS `MS_Fee`,
      IFNULL(STCAB2,0) AS `STCAB2`,
      IFNULL(E_learning,0) AS `E_learning`,
      IFNULL(Cultural_fee,0) AS `Cultural_fee`,
      IFNULL(Insurance,0) AS `Insurance`,
      IFNULL(oracle,0) AS `oracle`,
      IFNULL(hp,0) AS `hp`,
      IFNULL(sap,0) AS `sap`,
      collection_report1.`Month`,
      collection_report1.yr,
      IFNULL(seniorhigh,0) AS `seniorhigh`,
      IFNULL(ched_deped,0) AS `ched_deped`
    FROM
      collection_report1
    INNER JOIN students ON collection_report1.acctno = students.acctno
    WHERE
      collection_report1.Month = '{$month}' AND
      collection_report1.yr = '{$year}'
    ORDER BY
      collection_report1.`OR` ASC");
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $part=$this->getparticularOR($row->acctno,$row->OR);
        $gross=$row->Tuition_Fee+$row->Lab_Fee+$row->Internet_Fee+$row->Office365+$row->Miscellaneous+$row->Networking+$row->Physics+$row->STCAB1+$row->Special_Exam_50P1+$row->Others1+$row->Others+$row->Merchandise+$row->SC+$row->Newsletter+$row->Special_Exam_50P2+$row->Others2+$row->Ncc_uk+$row->MS_Fee+$row->STCAB2+$row->E_learning+$row->Cultural_fee+$row->Insurance+$row->oracle+$row->hp+$row->sap+$row->ched_deped;
        $query1 = $this->db->query("SELECT
          collectionreport.collectionReportId
        FROM
          collectionreport
        WHERE
          collectionreport.`or` = '$row->OR'");
        if ($query1->num_rows() > 0)
        {
          foreach ($query1->result() as $row1)
          {
            $collectionReportId=$row1->collectionReportId;
            $data2 = array(
            'date' => $row->pdate,
            'name' => $row->name,
            'particular' => $part,
            'grossReceipt' => $gross,
            'merchandise' => $row->Merchandise,
            'others' => $row->Others1+$row->Others+$row->Others2,
            'unifast' => $row->ched_deped,
            'specialExam' => $row->Special_Exam_50P1+$row->Special_Exam_50P2,
            'scnl' => $row->SC+$row->Newsletter,
            'elearning' => $row->E_learning,
            'nccUk' => $row->Ncc_uk,
            'msFee' => $row->MS_Fee,
            'oracle' => $row->oracle,
            'hp' => $row->hp,
            'studentServices' => $row->Cultural_fee,
            'sap' => $row->sap,
            'stcab' => $row->STCAB1+$row->STCAB2,
            'insurance' => $row->Insurance,
            'office365' => $row->Office365,
            'shs' => $row->seniorhigh,
            'netR' => $row->Tuition_Fee+$row->Lab_Fee+$row->Internet_Fee+$row->Miscellaneous+$row->Networking+$row->Physics
            );
            $this->db->where(array('collectionReportId' => $collectionReportId,'OR' => $row->OR));
            $this->db->update('collectionreport', $data2);
          }
        }
        else
        {
          $arr['date']=$row->pdate;
          $arr['OR']=$row->OR;
          $arr['name']=$row->name;
          $arr['particular']=$part;
          $arr['grossReceipt']=$gross;
          $arr['merchandise']=$row->Merchandise;
          $arr['others']=$row->Others1+$row->Others+$row->Others2;
          $arr['unifast']=$row->ched_deped;
          $arr['specialExam']=$row->Special_Exam_50P1+$row->Special_Exam_50P2;
          $arr['scnl']=$row->SC+$row->Newsletter;
          $arr['elearning']=$row->E_learning;
          $arr['nccUk']=$row->Ncc_uk;
          $arr['msFee']=$row->MS_Fee;
          $arr['oracle']=$row->oracle;
          $arr['hp']=$row->hp;
          $arr['studentServices']=$row->Cultural_fee;
          $arr['sap']=$row->sap;
          $arr['stcab']=$row->STCAB1+$row->STCAB2;
          $arr['insurance']=$row->Insurance;
          $arr['office365']=$row->Office365;
          $arr['shs']=$row->seniorhigh;
          $arr['netR']=$row->Tuition_Fee+$row->Lab_Fee+$row->Internet_Fee+$row->Miscellaneous+$row->Networking+$row->Physics;
          $this->db->insert('collectionreport',$arr);
          unset($arr);
        }
      }
    }
    return json_encode($data);
  }
  function getparticularOR($acctno,$or)
  {
    $DB4 = $this->load->database('db4', TRUE);
    $part="";
    $query = $DB4->query("SELECT
      ordetails.Particular
    FROM
      ordetails
    WHERE
      ordetails.`OR` = '{$or}' AND
      ordetails.acctno = '{$acctno}'");
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $part.= $row->Particular.", ";
      }
    }
    return $part;
  }
  //delete fee sched
	function deletesched($id)
	{
		$this->db->delete('fee_schedule', array('feeSchedId' => $id));
	}
  //delete user
	function deleteuser($id)
	{
		$this->db->delete('users', array('userId' => $id));
	}
  //add user
	function saveuser()
  {
    $arr['username']=$this->input->post('username');
    $arr['password']=md5($this->input->post('password'));
    $arr['userRole']=$this->input->post('userrole');
    $arr['created_at']=date('Y-m-d H:i:s');
    return $this->db->insert('users',$arr);
	}
  //save fee sched
	function savesched()
  {
    $arr['month']=$this->input->post('month');
    $arr['year']=$this->input->post('year');
    $arr['percent']=$this->input->post('percent');
    $arr['label']=$this->input->post('term');
    $arr['semId']=$this->input->post('sem');
    $arr['syId']=$this->input->post('sy');
		return $this->db->insert('fee_schedule',$arr);
	}
  //get sy id
	function getsyid()
	{
		$query = $this->db->query("SELECT
			sy.syId,
			sy.sy
		FROM
			sy
		ORDER BY
			sy
		DESC")->result();

		return $query;
	}
  //set user status
	function updatestatus($id,$stat)
	{
    $data = array(
      'userStatus' => $stat,
      'updated_at' => date('Y-m-d H:i:s')
    );
    $this->db->where('userId', $id);
    $this->db->update('users', $data);
	}
  // update user
	function updateuser($id)
	{
    $data = array(
      'username' => $this->input->post('username'.$id),
      'password' => md5($this->input->post('password'.$id)),
      'userRole' => $this->input->post('userrole'.$id),
      'updated_at' => date('Y-m-d H:i:s')
    );
    $this->db->where('userId', $id);
    $this->db->update('users', $data);
	}
  //fetch school year
	function getsy()
	{
    $query = $this->db->query("SELECT * FROM `sy` ORDER BY `sy` DESC")->result();
    return json_encode($query);
	}
  // add particular
	function saveparticular()
  {
    $arr['particularName']=$this->input->post('particular');
    $arr['amt1']=$this->input->post('amount1');
    $arr['amt2']=$this->input->post('amount2');
    $arr['courseType']=$this->input->post('courseType');
    $arr['billType']=$this->input->post('billType');
    $arr['studentStatus']=$this->input->post('studentStatus');
    $arr['feeType']=$this->input->post('feeType');
    $arr['semId']=$this->input->post('sem');
    $arr['syID']=$this->input->post('sy');
    $arr['collectionReportGroup']=$this->input->post('collection');
    return $this->db->insert('particulars',$arr);
	}
  //generate account slip
	function generate($id,$sy,$sem,$level)
	{
		$DB2 = $this->load->database('db2', TRUE);//sis_main_db
		$DB3 = $this->load->database('db3', TRUE);//curriculum_final
		$data=array();
		$student=array();
		$payment=array();
		$per=array();
		$ssid;
		$query = $DB2->query("SELECT DISTINCT
			stud_sch_info.ssi_id,
			stud_sch_info.stud_id,
			stud_per_info.fname,
			stud_per_info.mname,
			stud_per_info.lname,
			program_list.prog_abv,
			program_list.`level`,
			acct_no
		FROM
			stud_sch_info
		INNER JOIN student_enrollment_stat ON student_enrollment_stat.ssi_id = stud_sch_info.ssi_id
		INNER JOIN stud_program ON stud_program.ssi_id = stud_sch_info.ssi_id AND student_enrollment_stat.sch_year = stud_program.sch_year AND student_enrollment_stat.semester = stud_program.semester
		INNER JOIN program_list ON stud_program.pl_id = program_list.pl_id
		INNER JOIN stud_per_info ON stud_sch_info.spi_id = stud_per_info.spi_id
		WHERE
			student_enrollment_stat.`status` = 'enrolled' AND
			program_list.`level` = '{$level}' AND
			student_enrollment_stat.sch_year = '{$sy}' AND
			student_enrollment_stat.semester = '{$sem}' {$id}
		ORDER BY
			stud_per_info.lname ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)

			{
				unset($payment);
				//total assessment
				$assessment=0;
				$asess = $this->db->query("SELECT
					Sum(assessment.amt1)AS amt1,
					Sum(assessment.amt2)AS amt2
					FROM
						assessment
					INNER JOIN sem ON assessment.semId = sem.semId
					INNER JOIN sy ON assessment.syId = sy.syId
					WHERE
						assessment.ssi_id = '{$row->ssi_id}' AND
						sem.sem = '{$sem}' AND
						sy.sy = '{$sy}' AND
						(assessment.feeType <> 'Bridging' AND
						assessment.feeType <> 'Tutorial')");
				if ($asess->num_rows() > 0)
				{
					foreach ($asess->result() as $row1)
					{
						$assessment=$row1->amt2;
					}
				}
				//discount
				$dis=0;
				$discount = $this->db->query("SELECT
					Sum(discount.amt2) AS amt2
				FROM
					discount
				INNER JOIN sem ON discount.semId = sem.semId
				INNER JOIN sy ON discount.syId = sy.syId
				WHERE
					discount.ssi_id = '{$row->ssi_id}' AND
					sem.sem = '{$sem}' AND
					sy.sy = '{$sy}'");
				if ($discount->num_rows() > 0)
				{
					foreach ($discount->result() as $row1)
					{
						$dis=$row1->amt2;
					}
				}
				$assessment=$assessment-$dis;
				// regular payment
				$pay = $this->db->query("SELECT DISTINCT
					payments.orNo,
					payments.paymentDate,
					payments.amt2
				FROM
					payments
				INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
				INNER JOIN assessment ON paymentdetails.assessmentId = assessment.assessmentId
				INNER JOIN sem ON payments.semId = sem.semId AND assessment.semId = sem.semId
				INNER JOIN sy ON payments.syId = sy.syId AND assessment.syId = sy.syId
				WHERE
					payments.ssi_id = '{$row->ssi_id}' AND
					sem.sem = '{$sem}' AND
					sy.sy = '{$sy}' AND
					(assessment.feeType <> 'Bridging' AND
					assessment.feeType <> 'Tutorial')");
				if ($pay->num_rows() > 0)
				{
					foreach ($pay->result() as $row1)
					{
						$payment[]=["or"=>$row1->orNo,"date"=>$row1->paymentDate,"amt2"=>$row1->amt2];
					}
				}
				else
				{
					$payment[]=[];
				}
				// fee sched percent
				if ($level=="College")
				{
					$prelim=0.45;
					$midterm=0.65;
					$prefinal=0.85;
					$final=1;
					$percent = $this->db->query("SELECT
					fee_schedule.label,
					fee_schedule.percent
				FROM
					fee_schedule
				INNER JOIN sem ON fee_schedule.semId = sem.semId
				INNER JOIN sy ON fee_schedule.syId = sy.syId
				WHERE
					sem.sem = '{$sem}' AND
					sy.sy = '{$sy}'");
				if ($percent->num_rows() > 0)
				{
					foreach ($percent->result() as $row1)
					{
						if ($row1->label=="Prelim") {
							$prelim=$row1->percent;
						}
						else if ($row1->label=="Midterm")
						{
							$midterm=$row1->percent;
						}
						else if ($row1->label=="PreFinal")
						{
							$prefinal=$row1->percent;
						}
						else if ($row1->label=="Final")
						{
							$final=$row1->percent;
						}
					}

				}
				}
				else
				{
					$prelim=0.25;
					$midterm=0.25;
					$prefinal=0.25;
					$final=0.25;
				}


				//bridging
				$bridging=0;
				$bridg = $this->db->query("SELECT
					Sum(assessment.amt1) AS amt1,
					Sum(assessment.amt2) AS amt2
					FROM
						assessment
					INNER JOIN sem ON assessment.semId = sem.semId
					INNER JOIN sy ON assessment.syId = sy.syId
					WHERE
						assessment.ssi_id = '{$row->ssi_id}' AND
						assessment.feeType = 'Bridging'");
				if ($bridg->num_rows() > 0)
				{
					foreach ($bridg->result() as $row1)
					{
						$bridging=$row1->amt2;
					}
				}
				// bridging payent
				$bridgingpayment=0;
				$bridgingpay = $this->db->query("SELECT DISTINCT
					SUM(payments.amt2) AS amt2
				FROM
					payments
				INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
				INNER JOIN assessment ON paymentdetails.assessmentId = assessment.assessmentId
				INNER JOIN sem ON payments.semId = sem.semId AND assessment.semId = sem.semId
				INNER JOIN sy ON payments.syId = sy.syId AND assessment.syId = sy.syId
				WHERE
					payments.ssi_id = '{$row->ssi_id}' AND
					assessment.feeType = 'Bridging'");
				if ($bridgingpay->num_rows() > 0)
				{
					foreach ($bridgingpay->result() as $row1)
					{
						$bridgingpayment=$row1->amt2;
					}
				}
				//tutorial
				$tutorial=0;
				$tutor = $this->db->query("SELECT
					Sum(assessment.amt1) AS amt1,
					Sum(assessment.amt2) AS amt2
					FROM
						assessment
					INNER JOIN sem ON assessment.semId = sem.semId
					INNER JOIN sy ON assessment.syId = sy.syId
					WHERE
						assessment.ssi_id = '{$row->ssi_id}' AND
						assessment.feeType = 'Tutorial'");
				if ($tutor->num_rows() > 0)
				{
					foreach ($tutor->result() as $row1)
					{
						$tutorial=$row1->amt2;
					}
				}
				// tutorial payent
				$tutorialpayment=0;
				$tutorialpay = $this->db->query("SELECT DISTINCT
					payments.orNo,
					payments.paymentDate,
					payments.amt2
				FROM
					payments
				INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
				INNER JOIN assessment ON paymentdetails.assessmentId = assessment.assessmentId
				INNER JOIN sem ON payments.semId = sem.semId AND assessment.semId = sem.semId
				INNER JOIN sy ON payments.syId = sy.syId AND assessment.syId = sy.syId
				WHERE
					payments.ssi_id = '{$row->ssi_id}' AND
					assessment.feeType = 'Tutorial'");
				if ($tutorialpay->num_rows() > 0)
				{
					foreach ($tutorialpay->result() as $row1)
					{
						$tutorialpayment=$row1->amt2;
					}
				}

				$old=$this->oldaccount($row->ssi_id,$sy,$sem);
				$assessold=$this->checkoldsys2($row->acct_no);
				$bridgold=$this->checkoldsys3($row->acct_no);
				$tutorialold=$this->checkoldsys4($row->acct_no);
				//for ($i=0; $i < 1000; $i++) {
					$student[]=["level"=>$level,"ssi_id"=>$row->ssi_id,"stud_id"=>$row->stud_id,"fname"=>$row->fname,"mname"=>$row->mname,"lname"=>$row->lname,"prog_abv"=>$row->prog_abv,"level"=>$row->level,"assessment"=>$assessment,"payment"=>$payment,"prelim"=>$prelim,"midterm"=>$midterm,"prefinal"=>$prefinal,"final"=>$final,"old"=>$old,"bridging"=>$bridging,"bridgingpayment"=>$bridgingpayment,"tutorial"=>$tutorial,"tutorialpayment"=>$tutorialpayment,"assessold"=>$assessold,"bridgold"=>$bridgold,"tutorialold"=>$tutorialold];
				//}
			}
		}else{
			$student[]=[];
		}
		$data[]=["student"=>$student];
		return json_encode($data);
	}
  // delete particular
	function deleteParticular($id)
	{
		if($this->db->delete('particulars', array('particularId' => $id))){
			return true;
		}
		return false;

	}
  // fetch particulars
	function getparticulars()
  {
    $query = $this->db->query("SELECT
      particulars.particularId,
      particulars.particularName,
      particulars.amt1,
      particulars.amt2,
      particulars.courseType,
      particulars.studentStatus,
      particulars.feeType,
      particulars.billType,
      particulars.semId,
      particulars.syId,
      sy.sy,
      sem.sem
    FROM
      particulars
    INNER JOIN sy ON particulars.syId = sy.syId
    INNER JOIN sem ON particulars.semId = sem.semId
    ORDER BY
      sy.sy DESC,
      sem.sem ASC")->result();
    return $query;
	}
  // add discount
	function insertBatchDiscounts($datas,$id,$sy,$sem)
	{
		//$this->db->delete('discount', array('ssi_id' => $id, 'syId'=>$sy, 'semId'=>$sem, 'discountDesc !='=>'1st Year'));
		return $this->db->insert_batch('discount', $datas);
	}
  // delete discount
 	function removeDiscounts($id,$sy,$sem)
 	{
    return $this->db->delete('discount', array('ssi_id' => $id, 'syId'=>$sy, 'semId'=>$sem, 'discountDesc !='=>'1st Year'));
	}
  // remove other fee (Handling Fee)
	function removeOthers($id,$sy,$sem)
	{
		return $this->db->delete('assessment', array('ssi_id' => $id, 'syId'=>$sy, 'semId'=>$sem,'particular'=>'Handling Fee'));
	}
  //update flow status
  function updateflow($id)
  {
    $DB2 = $this->load->database('db2', TRUE);
    $data = array(
      'mode' => "done",
      'updated_at' => date('Y-m-d H:i:s')
    );
    $DB2->where('efsm_id', $id);
    $DB2->update('efs_student_modes', $data);

  }

}


?>
