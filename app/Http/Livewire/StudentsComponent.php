<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Students;

class StudentsComponent extends Component
{
    public $student_id,$name,$email,$phone,$student_edit_id,$student_delete_id;

    public $view_student_id, $view_student_name, $view_student_email, $view_student_phone;


    //used to update fields
    public function updated($fields){
        
        $this->validateOnly($fields,[
            'student_id'=>'required|unique:students,student_id,'.$this->student_edit_id.'',   //validation with ignoring own data
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
        ]);
    }


    public function storeStudentData(){

        //on form submit
        $this->validate([
            'student_id'=>'required|unique:students',   //students= table name
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
        ]);

        //adding student data for
        $student = new Students();
        $student->student_id=$this->student_id;
        $student->name=$this->name;
        $student->email=$this->email;
        $student->phone=$this->phone;
        $student->save();
        session()->flash('message','New Student Added successfully!');

        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';


        //for dismissing the modal after sucess 
        $this->dispatchBrowserEvent('close-modal');        

    }

    public function render()
    {

        $students = Students::all();
        return view('livewire.students-component',['students'=>$students])->layout('livewire.layouts.base');
    }

    public function resetInputs(){
        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->student_edit_id = '';
    }

    public function editStudents($id){ 

        //to retrieve the data into the model
        $student = Students::where('id', $id)->first();
        
        $this->student_edit_id = $student->id;
        $this->student_id = $student->student_id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;

        $this->dispatchBrowserEvent('show-edit-student-modal');
        
    }

    public function editStudentData(){
        
        //on form submit
        $this->validate([
            'student_id'=>'required|unique:students,student_id,'.$this->student_edit_id.'',   //validation with ignoring own data
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
        ]);

        $student = Students::where('id', $this->student_edit_id)->first();

        //editing student data 
        $student->student_id=$this->student_id;
        $student->name=$this->name;
        $student->email=$this->email;
        $student->phone=$this->phone;
        $student->save();
        session()->flash('message','Student Updated successfully!');

        $this->dispatchBrowserEvent('close-modal'); 
    }

    //delete confirmation
    public function deleteConfirmation($id){ 

        //$student = Students::where('id',$id)->first();

        $this->student_delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    public function deleteStudentData(){
        $student = Students::where('id',$this->student_delete_id)->first();
        $student->delete();
        session()->flash('message','Student deleted successfully!');
        $this->dispatchBrowserEvent('close-modal');
    }
    
    //function to cancel delete request
    public function cancel() {
        $this->dispatchBrowserEvent('close-modal');

    }

    public function viewStudentDetails($id){ 

        //to retrieve the data into the model
        $student = Students::where('id', $id)->first();
        
        $this->view_student_id = $student->student_id;
        $this->view_student_name = $student->name;
        $this->view_student_email = $student->email;
        $this->view_student_phone = $student->phone;

        $this->dispatchBrowserEvent('show-view-student-modal');
        
    }

    //function to close the modal of view student
    public function closeViewStudentModal(){
        $this->view_student_id = '';
        $this->view_student_name = '';
        $this->view_student_email = '';
        $this->view_student_phone = '';
    }

}
