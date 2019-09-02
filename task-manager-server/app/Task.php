<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable =['name','user_id'];
    /*
     * add task
     */
    public function add($name){
        Task::create($name);
    }
    public function edit($data){
        Task::where('id',$data['id'])->update(['name'=>$data['name']]);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
