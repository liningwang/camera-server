<?php
/**
 * Demos Dao
 *
 * @category   Demos
 * @package    Demos_Dao_Core
 * @author     James.Huang <shagoo@gmail.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    $Id$
 */

require_once 'Demos/Dao/Core.php';
require_once 'Demos/Dao/Core/Customer.php';

/**
 * @package Demos_Dao_Core
 */
class Core_ReplyRoad extends Demos_Dao_Core
{
	/**
	 * @static
	 */
	const TABLE_NAME = 'replyroad';
	
	/**
	 * @static
	 */
	const TABLE_PRIM = 'id';
	
	/**
	 * Initialize
	 */
	public function __init () 
	{
		$this->t1 = self::TABLE_NAME;
		$this->k1 = self::TABLE_PRIM;
		
		$this->_bindTable($this->t1, $this->k1);
	}
	/**
	 * Get comment reply list
	 * @param int $cameraId
	 */
	public function getRoadScanById ($commentId)
	{
		$sql = $this->select()
			->from($this->t1, '*')
			->where("{$this->t1}.safeId = ?", $commentId)
			->where("{$this->t1}.scan = 0")
			->order("{$this->t1}.uptime desc");
			
		$res = $this->dbr()->fetchAll($sql);
		return $res;
	}
	
	/**
	 * Get comment reply list
	 * @param int $cameraId
	 */
	public function getListById ($commentId)
	{
		$list = array();
		$sql = $this->select()
			->from($this->t1, '*')
			->where("{$this->t1}.safeId = ?", $commentId)
			->order("{$this->t1}.uptime desc");
			
		
		$res = $this->dbr()->fetchAll($sql);
		/*if ($res) {
			$customerDao = new Core_Customer();
			foreach ($res as $row) {
				$customer = $customerDao->read($row['customerid']);
				$comment = array(
					'id'		=> $row['id'],
					'content'	=> '<b>'.$customer['name'].'</b> : '.$row['content'],
					'uptime'	=> $row['uptime'],
				);
				array_push($list, $comment);
			}
		}
		return $list;*/
		return $res;
	}
	
	/**
	 * Get customer comment list 
	 * @param string $customerId Customer ID
	 * @param int $pageId
	 */
	public function getListByCustomer ($customerId, $pageId = 0)
	{
		$list = array();
		$sql = $this->select()
			->from($this->t1, '*')
			->where("{$this->t1}.customerid = ?", $customerId)
			->order("{$this->t1}.uptime desc")
			->limitPage($pageId, 10);
		
		return $this->dbr()->fetchAll($sql);
	}
}