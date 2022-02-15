<?php
class rooms{

	public $con;

	public function __construct(){
    $this->con = mysqli_connect("127.0.0.1", "root", "","db_mfirooms");
	}
//-----------------------------------------------------VIEW------------------------------------------------------
	public function ViewBuilding(){
		$array = array();
		$query ="SELECT * from tbl_building";
		$execquery = mysqli_query($this->con,$query);
		while($building = mysqli_fetch_assoc($execquery)){
			array_push($array,$building);
		}
		return $array;
	}

	public function ViewFloors($id){
		$array = array();
		$query = "SELECT * from tbl_floor where building_id = $id";
		$execquery = mysqli_query($this->con,$query);
		while ($floor = mysqli_fetch_assoc($execquery)) {
			array_push($array,$floor);
		}
		return $array;
	}

	public function getFloor($id){
		$array = array();
		$query = "SELECT * from tbl_floor where floor_id = $id";
		$execquery = mysqli_query($this->con,$query);
		while ($floor = mysqli_fetch_assoc($execquery)) {
			array_push($array,$floor);
		}
		return $array;
	}

	public function getBuilding($id){
		$array = array();
		$query ="SELECT * from tbl_building where building_id = $id";
		$execquery = mysqli_query($this->con,$query);
		while($building = mysqli_fetch_assoc($execquery)){
			array_push($array,$building);
		}
		return $array;
	}

	public function ViewRoomType(){
		$array = array();
		$query ="SELECT * from tbl_room_type";
		$execquery = mysqli_query($this->con,$query);
		while($type = mysqli_fetch_assoc($execquery)){
			array_push($array,$type);
		}
		return $array;
	
	}
	public function ViewRooms($getBuildingId,$getFloorId){
		$array = array();
		$query ="SELECT * 
		FROM tbl_room 
		WHERE building_id = $getBuildingId 
        AND floor_id = $getFloorId 
        ORDER BY room_number";
        $execquery = mysqli_query($this->con,$query);
        while($room = mysqli_fetch_assoc($execquery)){
			array_push($array,$room);
		}
		return $array;
    }
//----------------------------------------------------CREATE----------------------------------------------------
    
}
?>