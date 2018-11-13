<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Todo;

class TodoController extends Controller
{
    public function listTodo(){
    	$list_todo = Todo::orderBy('id', 'desc')->get();
    	//print_r($list_todo);
    	if(count($list_todo)>0){
    		echo "<table>";
    		$i=0;
    		foreach ($list_todo as $row) {
    			echo '<tr>
    					<td><input type="checkbox" name="cb_data[]" id="cb_data_'.$i.'" id_data="'.$i.'" value="'.$row->id.'" class="cb_data" onclick="lineText('.$i.')"></td>
    					<td><span class="name" id="name_'.$i.'">'.$row->todoName.'</span></td>
    					<td> <span class="delete" id="'.$row->id.'" style="cursor:pointer">&nbsp;[X]</span></td>
    				  </tr>
    				 ';
    		$i++;
    		}
    		echo "</table>";
    	}
    }
    public function saveListTodo(Request $req){
    	$todoName = $req->todoName;
    	$data = array('todoName'=>$todoName);
    	$save = Todo::create($data);
    	if(!$save){
		    echo "0";
		}else{
			echo "1";
    	}
	}
	public function deleteListTodo(Request $req){
		$id	  = $req->id;
		$id_in	  = $req->id_in;
		if($id<>''){
			$todo = Todo::find($id);
			$todo->delete();
			echo "1";
		}
		if($id_in<>''){
			$todo = Todo::whereIn('id', explode(",",$id_in))->delete();
			echo "1";
		}
		//echo $id_in;
	}
}
