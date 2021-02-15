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
	// insert logs
	function logs($user,$activity)
	{
		$data1=array();
		$data1['user']=$user;
		$data1['activity']=$activity;
		$this->db->insert('userLog',$data1);
	}
	function chackmastercode($mastercode)
	{
		$mc=md5($mastercode);
		$query = $this->db->query("SELECT
			users.mastercode
		FROM `users`
		WHERE
			users.mastercode = '{$mc}'")->num_rows();

		if ($query > 0 ) {
			$data = array(
				'status' => "yes"
			);
		}else{
			$data = array(
				'status' => "no"
			);
		}
		return json_encode($data);
	}
	function savemastercode($mastercode)
	{
		$data = array(
			'mastercode' => md5($mastercode)
		);
		$this->db->where('userRole', "Admin");
		$this->db->update('users', $data);
		return json_encode($data);
	}
  //search student in fees
	function searchstudent($student)
	{
		$data=array();
    $DB2 = $this->load->database('db2', TRUE);//sis_main_db
    $DB3 = $this->load->database('db3', TRUE);//curriculum_final
		$query = $DB2->query("SELECT
			stud_per_info.lname,
			stud_per_info.fname,
			IFNULL(stud_per_info.mname,' ') AS `mname`,
			IFNULL(stud_per_info.suffix,' ') AS `suffix`,
			stud_sch_info.acct_no,
			stud_sch_info.ssi_id
		FROM
			stud_per_info
		INNER JOIN stud_sch_info ON stud_sch_info.spi_id = stud_per_info.spi_id
		WHERE
			stud_per_info.lname LIKE '{$student}%' OR
			stud_per_info.fname LIKE '{$student}%'
		ORDER BY
			stud_per_info.lname ASC,
			stud_per_info.fname ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{

				$data[]=[
					"lname"=>$row->lname,
					"fname"=>$row->fname,
					"mname"=>$row->mname,
					"suffix"=>$row->suffix,
					"acct_no"=>$row->acct_no,
					"ssi_id"=>$row->ssi_id,
					"accttype"=>"student"
				];
			}
		}
		$query = $this->db->query("SELECT
			other_payee.otherPayeeId AS `otherPeyeeId`,
			other_payee.payeeLast AS `lname`,
			other_payee.payeeFirst AS `fname`,
			IFNULL(other_payee.payeeMiddle,' ') AS `mname`,
			IFNULL(other_payee.payeeExt,' ') AS `suffix`,
			other_payee.payeeAddress AS `payeeAddress`
			FROM
			other_payee
			WHERE
						other_payee.payeeLast LIKE '{$student}%' OR
						other_payee.payeeFirst LIKE '{$student}%'
			ORDER BY
						other_payee.payeeLast ASC,
						other_payee.payeeFirst ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{

				$data[]=[
					"lname"=>$row->lname,
					"fname"=>$row->fname,
					"mname"=>$row->mname,
					"suffix"=>$row->suffix,
					"payeeAddress"=>$row->payeeAddress,
					"ssi_id"=>$row->otherPeyeeId,
					"accttype"=>"otherpayee"
				];
			}
		}
		return json_encode($data);
	}
	// search particulars
	function searchpart($searchtext,$syId,$semId)
	{
		$data=array();
    $DB2 = $this->load->database('db2', TRUE);//sis_main_db
    $DB3 = $this->load->database('db3', TRUE);//curriculum_final
    //datbaseama
		$query = $this->db->query("SELECT
			particulars.particularId,
			particulars.particularName,
			particulars.amt1,
			particulars.amt2,
			particulars.feeType
		FROM
			particulars
		WHERE
			particulars.feeType = 'others' AND
			particulars.particularName LIKE '%{$searchtext}%'AND
			particulars.syId = '{$syId}' AND
			particulars.semId = '{$semId}'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{

				$data[]=[
					"particularId"=>$row->particularId,
					"particularName"=>$row->particularName,
					"amt1"=>$row->amt1,
					"amt2"=>$row->amt2
				];
			}
		}
		return json_encode($data);
	}
	// check or
	function checkor($or,$type)
	{
		$data=array();
		$query = $this->db->query("SELECT
			IFNULL(sis_main_db.stud_per_info.lname,'') AS `lname1`,
			IFNULL(sis_main_db.stud_per_info.fname,'') AS `fname1`,
			IFNULL(sis_main_db.stud_per_info.mname,'') AS `mname1`,
			IFNULL(acs.other_payee.payeeLast,'') AS `lname2`,
			IFNULL(acs.other_payee.payeeFirst,'') AS `fname2`,
			IFNULL(acs.other_payee.payeeMiddle,'') AS `mname2`
		FROM
			acs.payments
		LEFT JOIN sis_main_db.stud_sch_info ON acs.payments.ssi_id = sis_main_db.stud_sch_info.ssi_id
		LEFT JOIN sis_main_db.stud_per_info ON sis_main_db.stud_sch_info.spi_id = sis_main_db.stud_per_info.spi_id
		LEFT JOIN acs.other_payee ON acs.other_payee.otherPayeeId = acs.payments.otherPayeeId
		WHERE
			payments.orNo = '{$or}' AND
			payments.printingType = '{$type}' AND
			payments.orStatus = 'ongoing'");
		if ($query->num_rows() > 0)
		{
			$list="";
			foreach ($query->result() as $row)
			{
				if ($row->lname1 !="" OR $row->fname1 !="") {
					$list.="<li>OR: ".$or." owned by: ".$row->lname1.", ".$row->fname1." ".$row->mname1."</li>";
				}
				else
				{
					$list.="<li>OR: ".$or." owned by: ".$row->lname2.", ".$row->fname2." ".$row->mname2."</li>";
				}

			}
			$data[]=['status'=>"yes",'name'=>$list];
		}
		else
		{
			$data[]=['status'=>"no"];
		}
		return json_encode($data);
	}
	//get nAR max
	function getmaxar($payprinttype)
	{
		$data=array();
		if ($payprinttype=="AR") {
			$query2 = $this->db->query("SELECT
				IFNULL(Max(payments.orNo),1000)+1 AS `or`
			FROM
				payments
			WHERE
				payments.printingType = '{$payprinttype}'");
			if ($query2->num_rows() > 0)
			{
				foreach ($query2->result() as $row2)
				{
					$data[]=['or'=>$row2->or];
				}
			}
		}
		else
		{
			$data[]=['or'=>""];
		}
		return json_encode($data);
	}
	// or details to print
	function printor($id)
	{
		$data=array();
		$misc=array();
		$query = $this->db->query("SELECT
			payments.paymentDate,
			payments.amt2,
			payments.printingType,
			payments.orNo
		FROM
			payments
		WHERE
			payments.paymentId = '{$id}'");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$query2 = $this->db->query("SELECT
					IFNULL(assessment.feeType,particulars.particularName) AS `particular`,
					SUM(paymentdetails.amt2) AS `amt2`
				FROM
					paymentdetails
				LEFT JOIN assessment ON paymentdetails.assessmentId = assessment.assessmentId
				LEFT JOIN particulars ON paymentdetails.particularId = particulars.particularId
				WHERE
					paymentdetails.paymentId = '{$id}'
				GROUP BY
					assessment.feeType,
					particulars.particularName
				ORDER BY
					assessment.priority ASC,
					particulars.priority ASC");
				if ($query2->num_rows() > 0)
				{
					foreach ($query2->result() as $row2)
					{
						$misc[]=['particular'=>$row2->particular,'amt'=>$row2->amt2];
					}
				}
				$data[]=['orNo'=>$row->orNo,'date'=>$row->paymentDate,'amt'=>$row->amt2,'printingType'=>$row->printingType,"misc"=>$misc];
			}
		}

		return json_encode($data);
	}
	// insert other payeee
	function saveotherpayee($fname,$mname,$lname,$ext,$address)
	{
		$arr['payeeFirst']=$fname;
		$arr['payeeMiddle']=$mname;
		$arr['payeeLast']=$lname;
		$arr['payeeExt']=$ext;
		$arr['payeeaddress']=$address;
		return $this->db->insert('other_payee',$arr);
	}
	//save assessment payment
	function savetobackup($id,$acctno,$payornum,$paydate,$payamt,$userrole,$sy,$sem,$payprinttype)
	{
		$sy1=$this->getid($sy,"sy");
		$sem1=$this->getid($sem,"sem");
		$arr['ssi_id']=$id;
		$arr['acctno']=$acctno;
		//$arr['otherPayeeId']="";
		$arr['orNo']=$payornum;
		$arr['paymentDate']=$paydate;
		$arr['amt1']=$payamt;
		$arr['amt2']=$payamt;
		$arr['paymentMode']="cash";
		$arr['cashier']=$userrole;
		$arr['syId']=$sy1;
		$arr['semId']=$sem1;
		$arr['printingType']=$payprinttype;
		$arr['paymentStatus']="active";
		$arr['status']="undone";
		$arr['orStatus']="ongoing";
		$d1=$this->db->insert('paymentbackup',$arr);
		return $this->redistributepayment($id,$sy,$sem,"temp");
	}
	//pay tutorial bridging
	function paytutorialbridging($id,$acctno,$payornum,$paydate,$payamt,$userrole,$syId,$semId,$payprinttype,$paytype)
	{
		$data=array();
		$arr1['ssi_id']=$id;
		$arr1['acctno']=$acctno;
		//$arr1['otherPayeeId']="";
		$arr1['orNo']=$payornum;
		$arr1['paymentDate']=$paydate;
		$arr1['amt1']=$payamt;
		$arr1['amt2']=$payamt;
		$arr1['paymentMode']="cash";
		$arr1['cashier']=$userrole;
		$arr1['syId']=$syId;
		$arr1['semId']=$semId;
		$arr1['printingType']=$payprinttype;
		$arr1['paymentStatus']="active";
		$arr1['orStatus']="ongoing";
		$d1=$this->db->insert('payments',$arr1);
		$paymentId=$this->db->insert_id();
		$amt1=$payamt;
		$amt2=$payamt;
		$query = $this->db->query("SELECT
			assessment.amt1-Sum(IFNULL(paymentdetails.amt1,0)) AS payable1,
			assessment.amt2-Sum(IFNULL(paymentdetails.amt2,0)) AS payable2,
			assessment.assessmentId AS id,
			assessment.particular,
			assessment.priority
		FROM
			assessment
		LEFT JOIN paymentdetails ON assessment.assessmentId = paymentdetails.assessmentId
		LEFT JOIN payments ON paymentdetails.paymentId = payments.paymentId AND assessment.ssi_id = payments.ssi_id
		WHERE
			assessment.ssi_id = '{$id}' AND
			assessment.syId = '{$syId}' AND
			assessment.semId = '{$semId}' AND
			assessment.feeType = '{$paytype}'
		GROUP BY
			assessment.assessmentId,
			assessment.amt1
		ORDER BY
			assessment.priority ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row1)
			{
				if ($row1->payable2<>0) {
					$n1=0;
					$n2=0;
					if ($amt1>0 OR $amt2>0) {
						$arr['assessmentId']=$row1->id;
						if ($row1->payable1>$amt1) {
							$arr['amt1']=$amt1;
							$n1=$amt1;
						}
						else
						{
							$arr['amt1']=$row1->payable1;
							$n1=$row1->payable1;
						}
						if ($row1->payable2>$amt2) {
							$arr['amt2']=$amt2;
							$n2=$amt2;
						}
						else
						{
							$arr['amt2']=$row1->payable2;
							$n2=$row1->payable2;
						}
						$arr['paymentId']=$paymentId;
						$this->db->insert('paymentdetails',$arr);
						$amt1=$amt1-$n1;
						$amt2=$amt2-$n2;
					}
				}
			}
			$data[]=['id'=>$paymentId];
		}
		else{
			$data[]=['status'=>"Error"];
		}
		return json_encode($data);
	}
	//save refundor
	function refundsave($id,$or,$amt,$date,$syId,$semId,$userrole,$note)
	{
		$data=array();
		$arr1['ssi_id']=$id;
		$arr1['or']=$or;
		$arr1['amt']=$amt;
		$arr1['date']=$date;
		$arr1['syId']=$syId;
		$arr1['semId']=$semId;
		$arr1['cashier']=$userrole;
		$arr1['note']=$note;
		$this->db->insert('refund',$arr1);
		if ($this->db->error()['message']) {
		    $result = 'Error! ['.$this->db->error()['message'].']';
		} else if (!$this->db->affected_rows()) {
		    $result = 'Error! query ['.$arr1.']';
		} else {
		    $result = 'Success';
		}
		$data[]=['result'=>$result];
		return json_encode($data);
	}
	//pay Others
	function payothers($id,$otherpayeeid,$acctno,$payornum,$paydate,$payamt,$userrole,$syId,$semId,$payprinttype,$paytype,$cart)
	{
		$data=array();
		$arr1['ssi_id']=$id;
		$arr1['acctno']=$acctno;
		$arr1['otherPayeeId']=$otherpayeeid;
		$arr1['orNo']=$payornum;
		$arr1['paymentDate']=$paydate;
		$arr1['amt1']=$payamt;
		$arr1['amt2']=$payamt;
		$arr1['paymentMode']="cash";
		$arr1['cashier']=$userrole;
		$arr1['syId']=$syId;
		$arr1['semId']=$semId;
		$arr1['printingType']=$payprinttype;
		$arr1['paymentStatus']="active";
		$this->db->insert('payments',$arr1);
		$paymentId=$this->db->insert_id();
		$amt1=$payamt;
		$amt2=$payamt;

		foreach ($cart as $row)
		{
			$arr['particularId']=$row['particulatId'];
			$arr['paymentId']=$paymentId;
			$arr['amt1']=$row['amt1'];
			$arr['amt2']=$row['amt2'];
			$this->db->insert('paymentdetails',$arr);
		}
		$data[]=['id'=>$paymentId];

		return json_encode($data);
	}
	function gettutorialbridgingamt($ssi_id,$syId,$semId,$type)
	{
		$amt1=0;
		$amt2=0;
		$data=array();
		$query=$this->db->query("SELECT
			assessment.amt1-Sum(IFNULL(paymentdetails.amt1,0)) AS payable1,
			assessment.amt2-Sum(IFNULL(paymentdetails.amt2,0)) AS payable2,
			assessment.assessmentId AS id,
			assessment.particular,
			assessment.priority
		FROM
			assessment
		LEFT JOIN paymentdetails ON assessment.assessmentId = paymentdetails.assessmentId
		LEFT JOIN payments ON paymentdetails.paymentId = payments.paymentId AND assessment.ssi_id = payments.ssi_id
		WHERE
			assessment.ssi_id = '{$ssi_id}' AND
			assessment.syId = '{$syId}' AND
			assessment.semId = '{$semId}' AND
			assessment.feeType = '{$type}'
		GROUP BY
			assessment.assessmentId,
			assessment.amt1
		ORDER BY
			assessment.priority ASC");
		if ($query->num_rows()>0){
			foreach ($query->result() as $row){
				$amt1=$amt1+$row->payable1;
				$amt2=$amt2+$row->payable2;
			}
		}
		$data[]=['amt1'=>$amt1,'amt2'=>$amt2];
		return json_encode($data);
	}
  // generate student info
  function searchinfo($ssi_id,$sem,$sy,$acctno)
	{
		$syId=$this->getid($sy,"sy");
		$semId=$this->getid($sem,"sem");
    $DB2 = $this->load->database('db2', TRUE);//sis_main_db
    $DB3 = $this->load->database('db3', TRUE);//curriculum_final
    //datbaseama
		$data=array();
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
		$is_graduating="";
		$weight="";
		$height="";
		$nationality="";
		$province_name="";
		$city_name="";
		$civ_status="";
		$phone_number="";
		$street="";
		$year="";
		$birthdate="";
		$birthplace="";
		$gender="";
		$lname="";
		$fname="";
		$mname="";
		$level="";
		$query6 = $DB2->query("SELECT
			IFNULL(parents.fname,' ') AS pfname,
			IFNULL(parents.mname,' ') AS pmname,
			IFNULL(parents.lname,' ') AS plname,
			IFNULL(phone_numbers.phone_number,' ') AS phone_number,
			IFNULL(telephone_numbers.telephone_number,' ') AS telephone_number,
			IFNULL(parents.birthdate,' ') AS birthdate,
			IFNULL(parents.occupation,' ') AS occupation,
			IFNULL(city.city_name,' ') AS city_name,
			IFNULL(prov.province_name,' ') AS province_name,
			IFNULL(relationship.relationship,' ') AS relationship,
			IFNULL(relationship.type_of_rel,' ') AS type_of_rel
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
			stud_sch_info.ssi_id = '{$ssi_id}'");
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
        stud_sch_info.ssi_id = '{$ssi_id}' AND
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

		$query1 = $DB2->query("SELECT
			IFNULL(stud_per_info.lname,' ') AS lname,
			IFNULL(stud_per_info.fname,' ') AS fname,
			IFNULL(stud_per_info.mname,' ') AS mname,
			IFNULL(stud_per_info.suffix,' ') AS suffix,
			IFNULL(stud_per_info.birthdate,' ') AS birthdate,
			IFNULL(stud_per_info.birthplace,' ') AS birthplace,
			IFNULL(stud_per_info.gender,' ') AS gender,
			IFNULL(`year`.`year`,' ') AS `year`,
			CONCAT(IFNULL(address.street,' '),' ',IFNULL(brgy.brgy_name,' '),' ',IFNULL(city.city_name,' ')) AS street,
			IFNULL(stud_per_info.weight,' ') AS weight,
			IFNULL(stud_per_info.height,' ') AS height,
			IFNULL(citizenship.nationality,' ') AS nationality,
			IFNULL(prov.province_name,' ') AS province_name,
			IFNULL(city.city_name,' ') AS city_name,
			IFNULL(stud_per_info.civ_status,' ') AS civ_status,
			IFNULL(phone_numbers.phone_number,' ') AS phone_number,
			IFNULL(`year`.is_graduating,' ') AS is_graduating,
			program_list.`level`,
			stud_program.semester,
			stud_program.sch_year
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
		LEFT JOIN stud_program ON stud_program.ssi_id = stud_sch_info.ssi_id AND `year`.sch_year = stud_program.sch_year AND `year`.semester = stud_program.semester
		LEFT JOIN program_list ON stud_program.pl_id = program_list.pl_id
		LEFT JOIN brgy ON address.brgy_id = brgy.brgy_id
		WHERE
			stud_sch_info.ssi_id = '{$ssi_id}' AND
			`year`.sch_year = '{$sy}' AND
			`year`.semester = '{$sem}'
		ORDER BY
			`year`.y_id DESC
		LIMIT 1");
		if ($query1->num_rows() > 0)
		{
			foreach ($query1->result() as $row1)
			{
				$is_graduating=$row1->is_graduating;
				$weight=$row1->weight;
				$height=$row1->height;
				$nationality=$row1->nationality;
				$province_name=$row1->province_name;
				$city_name=$row1->city_name;
				$civ_status=$row1->civ_status;
				$phone_number=$row1->phone_number;
				$street=$row1->street;
				$year=$row1->year;
				$birthdate=$row1->birthdate;
				$birthplace=$row1->birthplace;
				$gender=$row1->gender;
				$lname=$row1->lname;
				$fname=$row1->fname;
				$mname=$row1->mname;
				$suffix=$row1->suffix;
				$level=$row1->level;
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
		WHERE
			sem.sem = '{$sem}' AND
			sy.sy = '{$sy}'");
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
		$where="subject_enrolled.sch_year = '{$sy}' AND subject_enrolled.semester = '{$sem}' AND";
    $query = $DB2->query("SELECT
      student_enrollment_stat.`status`,
      student_enrollment_stat.sch_year,
      student_enrollment_stat.semester,
      program_list.prog_abv,
      `year`.year_stat,
      `year`.current_stat,
      `year`.is_graduating,
      program_list.`level`,
      stud_sch_info.stud_id AS `usn_no`,
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
      student_enrollment_stat.semester = '{$sem}'
		ORDER BY
			stud_program.sp_id DESC
		LIMIT 1");
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
					'otherPayments'=>$this->getOtherPayment($ssi_id),
					'studload'=>$this->getStudload($ssi_id," "),
					'sched'=>$this->getStudload($ssi_id,$where),
					'is_graduating'=>$is_graduating,
					'weight'=>$weight,
					'height'=>$height,
					'nationality'=>$nationality,
					'province_name'=>$province_name,
					'city_name'=>$city_name,
					'civ_status'=>$civ_status,
					'phone_number'=>$phone_number,
					'street'=>$street,
					'year_level'=>$year,
					'birthdate'=>$birthdate,
					'birthplace'=>$birthplace,
					'gender'=>$gender,
					'lname'=>$lname,
					'fname'=>$fname,
					'mname'=>$mname,
					'suffix'=>$suffix,
					'cname'=>$cname,
					'caddress'=>$caddress,
					'cnumber'=>$cnumber,
					'gfname'=>$gfname,
					'gphone_number'=>$gphone_number,
					'gtelephone_number'=>$gtelephone_number,
					'gbirthdate'=>$gbirthdate,
					'goccupation'=>$goccupation,
					'gcity_name'=>$gcity_name,
					'gprovince_name'=>$gprovince_name,
					'ffname'=>$ffname,
					'fphone_number'=>$fphone_number,
					'ftelephone_number'=>$ftelephone_number,
					'fbirthdate'=>$fbirthdate,
					'foccupation'=>$foccupation,
					'fcity_name'=>$fcity_name,
					'fprovince_name'=>$fprovince_name,
					'mfname'=>$mfname,
					'mphone_number'=>$mphone_number,
					'mtelephone_number'=>$mtelephone_number,
					'mbirthdate'=>$mbirthdate,
					'moccupation'=>$moccupation,
					'mcity_name'=>$mcity_name,
					'mprovince_name'=>$mprovince_name,
					'prelim'=>$prelim,
					'midterm'=>$midterm,
					'prefinal'=>$prefinal,
					'final'=>$final,
					'dl1'=>$dl1,
					'dl2'=>$dl2,
					'dl3'=>$dl3,
					'dl4'=>$dl4,
					'oldaccnewsys'=>$this->newsysoldacc($ssi_id,$syId,$semId)

				];
			}
		}
		else
		{
			$data[]=[
				'status'=>"No Data"
			];
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
	// get payments and transfer to paymentbackup
	function paymentbackup($id,$sy,$sem)
	{
		ini_set('max_execution_time', '0');
		$sy1=$this->getid($sy,"sy");
		$sem1=$this->getid($sem,"sem");
		$data=array();
		$query = $this->db->query("SELECT
			payments.ssi_id,
			payments.acctno,
			payments.otherPayeeId,
			payments.orNo,
			payments.paymentDate,
			payments.amt1,
			payments.amt2,
			payments.paymentMode,
			payments.cashier,
			sy.syId,
			sem.semId,
			payments.printingType,
			payments.paymentStatus,
			payments.orStatus,
			payments.paymentId
		FROM
			payments
		INNER JOIN sy ON payments.syId = sy.syId
		INNER JOIN sem ON payments.semId = sem.semId
		INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
		INNER JOIN assessment ON assessment.assessmentId = paymentdetails.assessmentId
		WHERE
			payments.ssi_id = '{$id}' AND
			sy.sy = '{$sy}' AND
			sem.sem = '{$sem}' AND
			payments.paymentStatus = 'active' AND
			payments.printingType = 'OR' AND
			(assessment.feeType <> 'Tutorial' AND assessment.feeType <> 'Bridging')
		GROUP BY
			payments.orNo");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data['ssi_id']=$row->ssi_id;
				$data['acctno']=$row->acctno;
				$data['otherPayeeId']=$row->otherPayeeId;
				$data['orNo']=$row->orNo;
				$data['paymentDate']=$row->paymentDate;
				$data['amt1']=$row->amt1;
				$data['amt2']=$row->amt2;
				$data['paymentMode']=$row->paymentMode;
				$data['cashier']=$row->cashier;
				$data['syId']=$row->syId;
				$data['semId']=$row->semId;
				$data['printingType']=$row->printingType;
				$data['paymentStatus']=$row->paymentStatus;
				$data['orStatus']=$row->orStatus;
				$data['status']="undone";
				$this->db->insert('paymentbackup',$data);
				$this->db->delete('paymentdetails', array('paymentId' => $row->paymentId));
				$this->db->delete('payments', array('paymentId' => $row->paymentId));
			}
		}
		$this->db->delete('assessment', array('ssi_id' => $id,'syid' => $sy1,'semId' => $sem1));
		return json_encode($data);
	}
	//redistribute payments
	function redistributepayment($id,$sy,$sem,$stat)
	{
		ini_set('max_execution_time', '0');
		$sy1=$this->getid($sy,"sy");
		$sem1=$this->getid($sem,"sem");
		$data=array();
		$query = $this->db->query("SELECT
			paymentbackup.backupId,
			paymentbackup.ssi_id,
			paymentbackup.acctno,
			paymentbackup.otherPayeeId,
			paymentbackup.orNo,
			paymentbackup.paymentDate,
			paymentbackup.amt1,
			paymentbackup.amt2,
			paymentbackup.paymentMode,
			paymentbackup.cashier,
			paymentbackup.syId,
			paymentbackup.semId,
			paymentbackup.printingType,
			paymentbackup.paymentStatus,
			paymentbackup.orStatus
		FROM
			paymentbackup
		WHERE
			paymentbackup.ssi_id = '{$id}' AND
			paymentbackup.syId = '{$sy1}' AND
			paymentbackup.semId = '{$sem1}'AND
			paymentbackup.status = 'undone'
		ORDER BY
			paymentbackup.paymentDate ASC,
			paymentbackup.orNo ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data1['ssi_id']=$row->ssi_id;
				$data1['acctno']=$row->acctno;
				$data1['otherPayeeId']=$row->otherPayeeId;
				$data1['orNo']=$row->orNo;
				$data1['paymentDate']=$row->paymentDate;
				$data1['amt1']=$row->amt1;
				$data1['amt2']=$row->amt2;
				$data1['paymentMode']=$row->paymentMode;
				$data1['cashier']=$row->cashier;
				$data1['syId']=$row->syId;
				$data1['semId']=$row->semId;
				$data1['printingType']=$row->printingType;
				$data1['paymentStatus']=$row->paymentStatus;
				$data1['orStatus']=$row->orStatus;
				$this->db->insert('payments',$data1);
				$paymentId=$this->db->insert_id();
				$data[]=['id'=>$paymentId];
				$data2 = array(
					'status' => "done"
				);
				$this->db->where(array('ssi_id' => $row->ssi_id,'orNo' => $row->orNo,'status' =>'undone'));
				$this->db->update('paymentbackup', $data2);

				$amt1=$row->amt1;
				$amt2=$row->amt2;
				$query = $this->db->query("SELECT
					assessment.amt1-Sum(IFNULL(paymentdetails.amt1,0)) AS payable1,
					assessment.amt2-Sum(IFNULL(paymentdetails.amt2,0)) AS payable2,
					assessment.assessmentId AS id,
					assessment.particular,
					assessment.priority
				FROM
					assessment
				LEFT JOIN paymentdetails ON assessment.assessmentId = paymentdetails.assessmentId
				LEFT JOIN payments ON paymentdetails.paymentId = payments.paymentId AND assessment.ssi_id = payments.ssi_id
				WHERE
					assessment.ssi_id = '{$id}' AND
					assessment.syId = '{$sy1}' AND
					assessment.semId = '{$sem1}' AND
					(assessment.feeType <> 'Tutorial' AND assessment.feeType <> 'Bridging')
				GROUP BY
					assessment.assessmentId,
					assessment.amt1
				ORDER BY
					assessment.priority ASC");
				if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $row1)
					{
						if ($row1->payable2<>0) {
							$n1=0;
							$n2=0;
							if ($amt1>0 OR $amt2>0) {
								$arr['assessmentId']=$row1->id;
								if ($row1->payable1>$amt1) {
									$arr['amt1']=$amt1;
									$n1=$amt1;
								}
								else
								{
									$arr['amt1']=$row1->payable1;
									$n1=$row1->payable1;
								}
								if ($row1->payable2>$amt2) {
									$arr['amt2']=$amt2;
									$n2=$amt2;
								}
								else
								{
									$arr['amt2']=$row1->payable2;
									$n2=$row1->payable2;
								}
								$arr['paymentId']=$paymentId;
								$this->db->insert('paymentdetails',$arr);
								$amt1=$amt1-$n1;
								$amt2=$amt2-$n2;
							}
						}
					}
				}
				if ($stat=="temp") {
					$this->db->delete('paymentbackup', array('backupId' => $row->backupId));
				}
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
	function loadotherpayeepayment($ssi_id)
	{
		$payment=array();
		$query = $this->db->query("SELECT
			payments.orNo,
			payments.paymentDate,
			particulars.particularName,
			paymentdetails.amt1,
			paymentdetails.amt2,
			sem.sem,
			sy.sy
		FROM
			payments
		INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
		INNER JOIN particulars ON particulars.particularId = paymentdetails.particularId
		INNER JOIN sem ON particulars.semId = sem.semId
		INNER JOIN sy ON particulars.syId = sy.syId
		WHERE
			payments.otherPayeeId = '{$ssi_id}'
		ORDER BY
			payments.paymentDate ASC,
			payments.orNo ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $payment[]=["sy"=>$row->sy,"sem"=>$row->sem,"orNo"=>$row->orNo,"paymentDate"=>$row->paymentDate,"particularName"=>$row->particularName,"amt1"=>$row->amt1,"amt2"=>$row->amt2];
			}
		}
    return json_encode($payment);

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
	function getpayhistory($id,$syId,$semId,$type,$accttype)
  {
    $payment=array();
    if ($type=="bridging")
    {
      $qry="AND assessment.feeType = 'Bridging'";
			$user="payments.ssi_id = '{$id}' AND  payments.syId = '{$syId}' AND payments.semId = '{$semId}'";
    }
    elseif ($type=="tutorial")
    {
      $qry="AND assessment.feeType = 'Tutorial'";
			$user="payments.ssi_id = '{$id}' AND  payments.syId = '{$syId}' AND payments.semId = '{$semId}'";
    }
    elseif($type=="assessment")
    {
      $qry="AND (assessment.feeType <> 'Tutorial' AND assessment.feeType <> 'Bridging')";
			$user="payments.ssi_id = '{$id}' AND  payments.syId = '{$syId}' AND payments.semId = '{$semId}'";
    }elseif($type=="others")
    {
      $qry="AND particulars.feeType = 'Others'";
			if ($accttype=="student") {
				$user=" payments.ssi_id = '{$id}' AND  payments.syId = '{$syId}' AND payments.semId = '{$semId}'";
			}else{
				$user=" payments.otherPayeeId = '{$id}'";
			}
    }
    $query = $this->db->query("SELECT
			payments.orNo,
			payments.paymentDate,
			payments.amt2,
			payments.paymentId,
			payments.paymentStatus,
			sum(paymentdetails.amt2) as `dtails`
		FROM
			payments
		INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
		LEFT JOIN assessment ON paymentdetails.assessmentId = assessment.assessmentId AND payments.semId = assessment.semId AND payments.syId = assessment.syId
		LEFT JOIN particulars ON particulars.particularId = paymentdetails.particularId AND payments.semId = particulars.semId AND payments.syId = particulars.syId
		WHERE
			".$user." ".$qry."
		GROUP BY
			payments.orNo,
			payments.paymentDate
		ORDER BY
			payments.paymentDate ASC,
			payments.orNo ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $payment[]=["paymentId"=>$row->paymentId,"orNo"=>$row->orNo,"paymentDate"=>$row->paymentDate,"amt2"=>$row->amt2,"dtails"=>$row->dtails,"paymentStatus"=>$row->paymentStatus];
			}
		}
    return json_encode($payment);
  }
	// refund History
	function refundhistory($id,$syId,$semId,$accttype)
  {
    $refund=array();
		if ($accttype=="student") {
			$where=" refund.ssi_id = '{$id}' AND refund.syId = '{$syId}' AND refund.semId = '{$semId}'";
		}else{
			$where=" refund.ssi_id = '{$id}'";
		}
    $query = $this->db->query("SELECT
			refund.refundId,
			refund.amt,
			refund.date,
			refund.cashier,
			refund.note,
			refund.`or`
		FROM
			refund
		WHERE
			".$where."
		ORDER BY
			refund.date ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $refund[]=["refundId"=>$row->refundId,"amt"=>$row->amt,"or"=>$row->or,"date"=>$row->date,"cashier"=>$row->cashier,"note"=>$row->note];
			}
		}
    return json_encode($refund);
  }
	//get otherpayment
	function getOtherPayment($ssi_id)
  {
    $payment=array();
    $query = $this->db->query("SELECT
			sy.sy,
			sem.sem,
			payments.orNo,
			payments.paymentDate,
			Sum(paymentdetails.amt1) AS amt1,
			Sum(paymentdetails.amt2) AS amt2,
			particulars.particularName
		FROM
	    payments
	    INNER JOIN paymentdetails ON paymentdetails.paymentId = payments.paymentId
	    INNER JOIN particulars ON paymentdetails.particularId = particulars.particularId AND payments.semId = particulars.semId AND payments.syId = particulars.syId
	    INNER JOIN sy ON payments.syId = sy.syId
	    INNER JOIN sem ON payments.semId = sem.semId
		WHERE
			payments.ssi_id = '{$ssi_id}'
		GROUP BY
			sy.sy,
			sem.sem,
			payments.orNo,
			payments.paymentDate,
			particulars.particularName
		ORDER BY
			sy.sy DESC,
			sem.sem DESC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $payment[]=["sy"=>$row->sy,"sem"=>$row->sem,"orNo"=>$row->orNo,"paymentDate"=>$row->paymentDate,"amt1"=>$row->amt1,"amt2"=>$row->amt2,"particularName"=>$row->particularName];
			}
		}
    return $payment;
  }
  // get studload
  function getStudload($ssi_id,$stat)
  {
    $DB2 = $this->load->database('db2', TRUE);//sis_main_db
    $DB3 = $this->load->database('db3', TRUE);//curriculum_final
    //datbaseama
    $studload=array();
    $query = $DB2->query("SELECT
      subject_enrolled.ss_id,
      subject_enrolled.sch_year,
      subject_enrolled.semester
    FROM
      subject_enrolled
    INNER JOIN subject_enrolled_status ON subject_enrolled.ses_id = subject_enrolled_status.ses_id
    WHERE
  		subject_enrolled.ssi_id = '{$ssi_id}' AND {$stat}
  		(subject_enrolled_status.`status` = 'enrolled' OR
  		subject_enrolled_status.`status` = 'add' OR
      subject_enrolled_status.`status` = 'change')
    ORDER BY
      subject_enrolled.sch_year DESC,
      subject_enrolled.semester DESC,
			subject_enrolled.ss_id ASC");
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
        $query2 = $DB3->query("SELECT
					`subject`.subj_id,
					`subject`.subj_code,
					`subject`.subj_name,
					`subject`.lec_unit,
					`subject`.lab_unit,
					IFNULL(sched_day.abbreviation,'') as `abbreviation`,
					IFNULL(subj_sched_day.time_start,'') as `time_start`,
					IFNULL(subj_sched_day.time_end,'') as `time_end`,
					IFNULL(room_list.room_code,'') as `room_code`,
					IFNULL(lab_type.description,'') as `description`,
					room_list.type
				FROM
					sched_subj
				INNER JOIN `subject` ON sched_subj.subj_id = `subject`.subj_id
				LEFT JOIN subj_sched_day ON subj_sched_day.ss_id = sched_subj.ss_id
				LEFT JOIN sched_day ON subj_sched_day.sd_id = sched_day.sd_id
				LEFT JOIN room_list ON subj_sched_day.rl_id = room_list.rl_id
				LEFT JOIN lab_type ON lab_type.lab_type_id = `subject`.lab_type_id
				WHERE
					sched_subj.ss_id = '{$row->ss_id}'");
    		if ($query2->num_rows() > 0)
    		{
    			foreach ($query2->result() as $row2)
    			{
            $studload[]=["sy"=>$row->sch_year,"sem"=>$row->semester,"subj_code"=>$row2->subj_code,"subj_name"=>$row2->subj_name,"lec_unit"=>$row2->lec_unit,"lab_unit"=>$row2->lab_unit,"abbreviation"=>$row2->abbreviation,"time_start"=>$row2->time_start,"time_end"=>$row2->time_end,"room_code"=>$row2->room_code,"subj_id"=>$row2->subj_id,"labType"=>$row2->description,"Type"=>$row2->type];
    			}
    		}
			}

		}
    return $studload;
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
		$priority="";
		//tuition
		$perunit = $this->db->query("SELECT
			particulars.amt1,
			particulars.amt2,
			sy.syId,
			sem.semId,
			particulars.courseType,
			particulars.collectionReportGroup,
			particulars.priority
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
				$priority=$row->priority;
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
				$this->insertpar($id,"Tuition(DEPED)",$tuition1,$tuition1,"Tuition",$semid,$syid,"shs",$priority);
				$this->insertpar($id,"Tuition",$tuition2,$tuition2,"Tuition",$semid,$syid,$collectionReportGroup,$priority);


			}
			else if ($highsector=="public")
			{
				//tuition
				$tuition1="20000";
				$tuition2="0";
				$this->insertpar($id,"Tuition(DEPED)",$tuition1,$tuition1,"Tuition",$semid,$syid,"shs",$priority);
				$this->insertpar($id,"Tuition",$tuition2,$tuition2,"Tuition",$semid,$syid,$collectionReportGroup,$priority);
			}
			else
			{
				//tuition
				$tuition1="0";
				$tuition2="20000";
				$this->insertpar($id,"Tuition(DEPED)",$tuition1,$tuition1,"Tuition",$semid,$syid,"shs",$priority);
				$this->insertpar($id,"Tuition",$tuition2,$tuition2,"Tuition",$semid,$syid,$collectionReportGroup,$priority);
			}
			$misc = $this->db->query("SELECT
				particulars.amt1,
				particulars.amt2,
				particulars.particularName,
				particulars.feeType,
				particulars.collectionReportGroup,
				particulars.priority
			FROM
				particulars
			INNER JOIN sy ON particulars.syId = sy.syId
			INNER JOIN sem ON particulars.semId = sem.semId
			WHERE
				(particulars.feeType = 'Miscellaneous' OR
				particulars.feeType = 'Registration Fee' OR
				particulars.feeType = 'Other Fee') AND
				particulars.studentStatus = '{$stat}' AND
				sy.sy = '{$sy}' AND
				sem.sem = '{$sem}' AND
				particulars.courseType = '{$courseType}'");
			if ($misc->num_rows() > 0)
			{
				foreach ($misc->result() as $row1)
				{
					if ($row1->particularName!="Online Fee") {
						$totalass1+=$row1->amt1;
						$totalass2+=$row1->amt2;
					}
					$this->insertpar($id,$row1->particularName,$row1->amt1,$row1->amt2,$row1->feeType,$semid,$syid,$collectionReportGroup,$row1->priority);
				}
			}

		}else{
			$tuition1=$perunitamt1*$totalunit;
			$tuition2=$perunitamt2*$totalunit;
			$totalass1+=$tuition1;
			$totalass2+=$tuition2;
			$this->insertpar($id,"Tuition",$tuition1,$tuition2,"Tuition",$semid,$syid,$collectionReportGroup,$priority);
			//misc
			$misc = $this->db->query("SELECT
				particulars.amt1,
				particulars.amt2,
				particulars.particularName,
				particulars.feeType,
				particulars.collectionReportGroup,
				particulars.priority
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
				particulars.feeType = 'Registration Fee' OR
				particulars.feeType = 'Other Fee')");
			if ($misc->num_rows() > 0)
			{
				foreach ($misc->result() as $row1)
				{
					if ($row1->particularName!="Online Fee") {
						$totalass1+=$row1->amt1;
						$totalass2+=$row1->amt2;
					}
					$this->insertpar($id,$row1->particularName,$row1->amt1,$row1->amt2,$row1->feeType,$semid,$syid,$row1->collectionReportGroup,$row1->priority);
				}
			}

			//lab subject
			//$this->db->delete('assessment', array('ssi_id' => $id,'syid' => $syid,'semId' => $semid,'feeType' => 'Laboratory'));
			$data2=array();
			$lab = $this->db->query("SELECT
				particulars.amt1,
				particulars.amt2,
				particulars.particularName,
				collectionReportGroup,
				particulars.collectionReportGroup,
				particulars.priority
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
					$lab1=0;
					$lab2=0;
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
						subject_enrolled.ssi_id ='{$id}'AND
						subject_enrolled.sch_year = '{$sy}' AND
						subject_enrolled.semester = '{$sem}'");
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
									$totalass1+=$labfee1;
									$totalass2+=$labfee1;
								}
							}
						}
					}

					if ($labname!="") {
						$this->insertpar($id,$row3->particularName,$lab1,$lab2,"Laboratory",$semid,$syid,$row3->collectionReportGroup,$row3->priority);
					}

				}

			}
			else
			{
				$this->db->delete('assessment', array('ssi_id' => $id,'syid' => $syid,'semId' => $semid,'feeType' => 'Laboratory'));
			}


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
				discount.amt2,
				discount.discountDesc
			FROM
				discount
			WHERE
				discount.ssi_id = '{$id}' AND
				discount.semId = '{$semid}' AND
				discount.syId = '{$syid}' AND
				discount.discountDesc LIKE 'Full Payment%'");
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
				$this->insertpar($id,"Handling Fee",$othersfee1,$othersfee2,"Handling Fee",$semid,$syid,"others","26");
			}
			else
			{
				foreach ($query5->result() as $row1)
				{
					if ($row1->discountDesc=="Full Payment w/o Handling Fee") {
						$this->db->delete('assessment', array('ssi_id' => $id,'syid' => $syid,'semId' => $semid,'particular' => 'Handling Fee'));
					}elseif ($row1->discountDesc=="Full Payment with Handling Fee 1.5%") {
						$othersfee1=($totalass1)*(1.5/100);
						$othersfee2=($totalass2)*(1.5/100);
						$this->insertpar($id,"Handling Fee",$othersfee1,$othersfee2,"Handling Fee",$semid,$syid,"others","26");
					}elseif ($row1->discountDesc=="Full Payment with Handling Fee 3%") {
						$othersfee1=($totalass1)*(3/100);
						$othersfee2=($totalass2)*(3/100);
						$this->insertpar($id,"Handling Fee",$othersfee1,$othersfee2,"Handling Fee",$semid,$syid,"others","26");
					}elseif ($row1->discountDesc=="Full Payment with Handling Fee 4.5%") {
						$othersfee1=($totalass1)*(4.5/100);
						$othersfee2=($totalass2)*(4.5/100);
						$this->insertpar($id,"Handling Fee",$othersfee1,$othersfee2,"Handling Fee",$semid,$syid,"others","26");
					}elseif ($row1->discountDesc=="Full Payment with Handling Fee 4%") {
						$othersfee1=($totalass1)*(4/100);
						$othersfee2=($totalass2)*(4/100);
						$this->insertpar($id,"Handling Fee",$othersfee1,$othersfee2,"Handling Fee",$semid,$syid,"others","26");
					}elseif ($row1->discountDesc=="Full Payment with Handling Fee 6%") {
						$othersfee1=($totalass1)*(6/100);
						$othersfee2=($totalass2)*(6/100);
						$this->insertpar($id,"Handling Fee",$othersfee1,$othersfee2,"Handling Fee",$semid,$syid,"others","26");
					}

				}


			}
		}
		//bridging & tutorial
		$subjectload = $DB2->query("SELECT
			subject_enrolled.ss_id
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
							$this->insertpar($id,$row1->subj_name,$bridg1,$bridg2,"Bridging",$semid,$syid,"others","27");
						}
						else
						{
							$query = $DB2->query("SELECT * FROM `subject_enrolled` WHERE `ss_id` ='{$ss_id}'");
							$noe = $query->num_rows();
							$tutor1=($perunitamt1*$row1->unit)*(15-$noe)/$noe;
							$tutor2=($perunitamt2*$row1->unit)*(15-$noe)/$noe;
							$this->insertpar($id,$row1->subj_name,$tutor1,$tutor2,"Tutorial",$semid,$syid,"others","28");
						}
					}
				}
			}
		}
		return json_encode($data);

	}
	// insert particular to assessment
	function insertpar($ssi_id,$particular,$amt1,$amt2,$feeType,$semId,$syId,$collectionReportGroup,$priority)
	{
		if ($amt1!=0 OR $amt2 !=0 OR $amt1!="" OR $amt2 !="") {
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
						'collectionReportGroup' => $collectionReportGroup,
						'priority'=> $priority
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
				$arr['priority']=$priority;
				return $this->db->insert('assessment',$arr);
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
    // else
    // {
    //   $set="AND (assessment.feeType <> 'Tutorial' AND assessment.feeType <> 'Bridging')";
    // }
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

	//delete or
	function deleteor($id)
	{
		$data=array();
		$this->db->delete('paymentdetails', array('paymentId' => $id));
		$this->db->delete('payments', array('paymentId' => $id));
		if ($this->db->error()['message']) {
		    $result = 'Error! ['.$this->db->error()['message'].']';
		} else if (!$this->db->affected_rows()) {
		    $result = 'Error! ID ['.$id.'] not found';
		} else {
		    $result = 'Success';
		}
		$data[]=['result'=>$result];
		return json_encode($data);
	}
	//delete refund
	function deleterefund($id)
	{
		$data=array();
		$this->db->delete('refund', array('refundId' => $id));
		if ($this->db->error()['message']) {
		    $result = 'Error! ['.$this->db->error()['message'].']';
		} else if (!$this->db->affected_rows()) {
		    $result = 'Error! ID ['.$id.'] not found';
		} else {
		    $result = 'Success';
		}
		$data[]=['result'=>$result];
		return json_encode($data);
	}

	//cancel or
	function cancelor($id)
	{
		$data=array();
		$data1 = array(
			'amt1' => 0,
			'amt2' => 0
		);
		$this->db->where('paymentId', $id);
		$this->db->update('paymentdetails', $data1);
		$data2 = array(
			'amt1' => 0,
			'amt2' => 0,
			'paymentStatus' => "canceled"
		);
		$this->db->where('paymentId', $id);
		$this->db->update('payments', $data2);
		if ($this->db->error()['message']) {
		    $result = 'Error! ['.$this->db->error()['message'].']';
		} else if (!$this->db->affected_rows()) {
		    $result = 'Error! ID ['.$id.'] not found';
		} else {
		    $result = 'Success';
		}
		$data[]=['result'=>$result];
		return json_encode($data);
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
	// get tuition
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
      (assessment.feeType <> 'Handling Fee' AND
      assessment.feeType <> 'Tutorial' AND
      assessment.feeType <> 'Bridging')");
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

}
?>
