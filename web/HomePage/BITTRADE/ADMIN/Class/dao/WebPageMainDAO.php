<?php
/**
* Description of WebPageMainDAO
* @description Funhansoft PHP auto templet
* @date 2013-10-04
* @copyright (c)funhansoft.com
* @license http://funhansoft.com/license
* @version 0.2.3
*/
        class WebPageMainDAO extends BaseDAO{

            private $db;
            private $dbSlave;

            function __construct() {
                parent::__construct();
            }

            public function getViewById($pm_no){
                $dto = new WebPageMainDTO();
                if(!$this->dbSlave) $this->dbSlave=parent::getDatabaseSlave(); if($this->dbSlave){
                    try{
                        $sql = "SELECT 	pm_no,
                                    pm_id,
                                    pm_subject,
                                    pm_content,
                                    pm_content_kr,
                                    pm_content_cn,
                                    pm_view_level,
                                    pm_reg_dt,
                                    pm_mod_dt
                                FROM web_page_main WHERE pm_no=?  limit 1";

                        if($this->dbSlave) $stmt = $this->dbSlave->prepare($sql);
                        if($stmt){
                            $stmt->bindValue( 1, $pm_no, PDO::PARAM_STR);
                            $stmt->execute();
                            list(
                                $dto->pmNo,
                                $dto->pmId,
                                $dto->pmSubject,
                                $dto->pmContent,
                                $dto->pmContentKr,
                                $dto->pmContentCn,
                                $dto->pmViewLevel,
                                $dto->pmRegDt,
                                $dto->pmModDt) = $stmt->fetch();
                            if($stmt->rowCount()==1) parent::setResult(1);
                            else parent::setResult(0);
                        }else{
                            parent::setResult(ResError::dbPrepare);
                        }
                    }catch(PDOException $e){ parent::setResult(ResError::dbPrepare);}
                }else{
                    parent::setResult(ResError::dbConn);
                }
                $dto->result = parent::getResult();
                return $dto;
            }

            public function getListCount($field='',$value='',$svdf='',$svdt=''){
                $dto = new CommonListDTO();
                if(!$this->dbSlave) $this->dbSlave=parent::getDatabaseSlave(); if($this->dbSlave){
                    try{
                        $singleFields = array('pm_no','pm_view_level');
                        $sql_add = $this->getListSearchSQL($singleFields,$field,$value);

                        $sql = "SELECT count(*)  FROM web_page_main{$sql_add}";

                        if($this->dbSlave) $stmt = $this->dbSlave->prepare($sql);
                        if($stmt){
                            if($value)
                                $stmt->bindValue( 1, $value, PDO::PARAM_STR);

                            $stmt->execute();
                            list($dto->totalCount) =  $stmt->fetch();
                            if($stmt->rowCount()==1) parent::setResult(1);
                            else parent::setResult(0);
                        }else{
                            parent::setResult(ResError::dbPrepare);
                        }
                    }catch(PDOException $e){ parent::setResult(ResError::dbPrepare);}
                }else{
                    parent::setResult(ResError::dbConn);
                }
                $dto->result = parent::getResult();
                $dto->totalPage = ceil((int)$dto->totalCount / parent::getListLimitRow() );
                $dto->limitRow =  (int)parent::getListLimitRow();

                return $dto;
            }

            public function getList($field='',$value='',$svdf='',$svdt=''){
                $dto = new WebPageMainDTO();
                $dtoarray = array();
                if(!$this->dbSlave) $this->dbSlave=parent::getDatabaseSlave(); if($this->dbSlave){
                    try{
                        $singleFields = array('pm_no','pm_view_level');
                        $sql_add = $this->getListSearchSQL($singleFields,$field,$value);
                        $sql_add .= $this->getListOrderSQL($singleFields,'pm_no');

                        $sql = "SELECT 	pm_no,
                                    pm_id,
                                    pm_subject,
                                    LEFT(pm_content,256),
                                    LEFT(pm_content_kr,256),
                                    LEFT(pm_content_cn,256),
                                    pm_view_level,
                                    pm_reg_dt,
                                    pm_mod_dt
                                FROM web_page_main{$sql_add} LIMIT ?,?";

                        if($this->dbSlave) $stmt = $this->dbSlave->prepare($sql);
                        if($stmt){
                            $j=1;
                            if($value)
                                $stmt->bindValue( $j++, $value, PDO::PARAM_STR);
                            $stmt->bindValue( $j++, parent::getListLimitStart(), PDO::PARAM_INT);
                            $stmt->bindValue( $j++, parent::getListLimitRow(), PDO::PARAM_INT);
                            $stmt->execute();

                            $i = 0;
                            while(list(
                                $dto->pmNo,
                                $dto->pmId,
                                $dto->pmSubject,
                                $dto->pmContentKr,
                                $dto->pmContentCn,
                                $dto->pmContent,
                                $dto->pmViewLevel,
                                $dto->pmRegDt,
                                $dto->pmModDt) = $stmt->fetch()) {
                                    $dtoarray[$i] = new WebPageMainDTO();
                                    parent::setResult($i+1);
                                    $dtoarray[$i]->pmNo = $dto->pmNo;
                                    $dtoarray[$i]->pmId = $dto->pmId;
                                    $dtoarray[$i]->pmSubject = $dto->pmSubject;
                                    $dtoarray[$i]->pmContent = strip_tags($dto->pmContent);
                                    $dtoarray[$i]->pmContentKr = strip_tags($dto->pmContentKr);
                                    $dtoarray[$i]->pmContentCn = strip_tags($dto->pmContentCn);
                                    $dtoarray[$i]->pmViewLevel = $dto->pmViewLevel;
                                    $dtoarray[$i]->pmRegDt = $dto->pmRegDt;
                                    $dtoarray[$i]->pmModDt = $dto->pmModDt;
                                    $i++;
                            }

                            if($i==0) parent::setResult(0);
                        }
                    }catch(PDOException $e){ parent::setResult(ResError::dbPrepare);}
                }else{
                    parent::setResult(ResError::dbConn);
                }
                $dto = null;
                return $dtoarray;
            }

            public function setInsert($dto){
                parent::setResult(-1);
                if(!$this->db) $this->db=parent::getDatabase(); if($this->db){
                    try{
                        $sql = "INSERT INTO web_page_main(
                                    pm_id,
                                    pm_subject,
                                    pm_content,
                                    pm_content_kr,
                                    pm_content_cn,
                                    pm_view_level,
                                    pm_mod_dt)
                                VALUES(?,?,?,?,?,?,?)";

                        if($this->db) $stmt = $this->db->prepare($sql);
                        if($stmt){
                            $j=1;
                            $stmt->bindValue( $j++, $dto->pmId, PDO::PARAM_STR);
                            $stmt->bindValue( $j++, $dto->pmSubject, PDO::PARAM_STR);
                            $stmt->bindValue( $j++, $dto->pmContent, PDO::PARAM_STR);
                            $stmt->bindValue( $j++, $dto->pmContentKr, PDO::PARAM_STR);
                            $stmt->bindValue( $j++, $dto->pmContentCn, PDO::PARAM_STR);
                            $stmt->bindValue( $j++, $dto->pmViewLevel, PDO::PARAM_INT);
                            $stmt->bindValue( $j++, $dto->pmModDt, PDO::PARAM_STR);
                            $stmt->execute();
                            if($stmt->rowCount()==1) parent::setResult($this->db->lastInsertId());
                            else parent::setResult(0);
                        }
                    }catch(PDOException $e){ parent::setResult(ResError::dbPrepare);}
                }else{
                    parent::setResult(ResError::dbConn);
                }
                return parent::getResult();
            }

            public function setUpdate($dto){
                parent::setResult(-1);
                if(!$this->db) $this->db=parent::getDatabase(); if($this->db){

                    $sql = "UPDATE web_page_main SET
                            pm_id=?,
                            pm_subject=?,
                            pm_content=?,
                            pm_content_kr=?,
                            pm_content_cn=?,
                            pm_view_level=?,
                            pm_mod_dt=? WHERE pm_no=?";

                    if($this->db) $stmt = $this->db->prepare($sql);
                    if($stmt){
                        $j=1;
                        $stmt->bindValue( $j++, $dto->pmId, PDO::PARAM_STR);
                        $stmt->bindValue( $j++, $dto->pmSubject, PDO::PARAM_STR);
                        $stmt->bindValue( $j++, $dto->pmContent, PDO::PARAM_STR);
                        $stmt->bindValue( $j++, $dto->pmContentKr, PDO::PARAM_STR);
                        $stmt->bindValue( $j++, $dto->pmContentCn, PDO::PARAM_STR);
                        $stmt->bindValue( $j++, $dto->pmViewLevel, PDO::PARAM_INT);
                        $stmt->bindValue( $j++, $dto->pmModDt, PDO::PARAM_STR);
                        $stmt->bindValue( $j++, $dto->pmNo, PDO::PARAM_INT);
                        $stmt->execute();
                        if($stmt->rowCount()==1) parent::setResult(1);
                        else parent::setResult(0);
                    }else{
                        parent::setResult(ResError::dbPrepare);
                    }
                }else{
                    parent::setResult(ResError::dbConn);
                }
                return parent::getResult();
            }

            function deleteFromPri($pri){
                parent::setResult(-1);
                if(!$this->db) $this->db=parent::getDatabase(); if($this->db){

                    $sql = "DELETE FROM web_page_main WHERE pm_no=?";

                    if($this->db) $stmt = $this->db->prepare($sql);
                    if($stmt){
                        $stmt->bindValue( 1, $pri, PDO::PARAM_STR);
                        $stmt->execute();
                        if($stmt->rowCount()>0) parent::setResult($stmt->rowCount());
                        else parent::setResult(0);
                    }else{
                        parent::setResult(ResError::dbPrepare);
                    }
                }else{
                    parent::setResult(ResError::dbConn);
                }
                return parent::getResult();
            }

            function __destruct(){
                $this->db = NULL;
                $this->dto = NULL;
            }
        }