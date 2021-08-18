<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Product;
use App\Package;
use App\Payment;
use App\Ticket;
use App\Membership_Level;
use App\Comment;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;
use Session;

class StudentPortal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('student_login_id')){
			return view("studentportal.dashboard");
		}else{
			return view("studentportal.login");
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm(Request $requet)
    {
        return view("studentportal.login");
    }

    public function login(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $student_detail = Student::where('email', '=',$validatedData['email'])->first();

        if($student_detail == (null || "")){

            Session::put("student_login", "fail");

            return redirect('/student/login');
        }else{

            $stud_id = $student_detail->stud_id;

            if (Hash::check($validatedData['password'], $student_detail->student_password)) {

                Session::put("student_login_id", $stud_id);

                Session::forget('student_login');
                
                return redirect('/student/dashboard/'.$stud_id);

            }else{
                
                return view("studentportal.login")->with('error', 'Login fail. Username or password are incorrect.');
            }
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();

        return view("studentportal.login");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($stud_id)
    {
        $student_authenticated = session('student_login_id');

        if($student_authenticated == (null||"")){
            return view("studentportal.login");

        }else{
            $student_detail = Student::where('stud_id', $stud_id)->firstOrFail();

            $payment = Payment::where('stud_id', $stud_id)
            ->orderBy('created_at', 'DESC')
            ->get();
    
            $member_lvl = Membership_Level::where('level_id', $student_detail->level_id)->first();
            $member_name;
    
            if($member_lvl != null){
                $member_name = $member_lvl->name;
            }
    
            $comment = Comment::where('stud_id', $stud_id)->get();
            
            $ncomment = [];
    
            if(count($comment) != 0) {
                foreach($comment as $c) {
                    $name = User::where('user_id', $c->add_user);
    
                    if($name->count() > 0) {
                        $name = $name->first();
                        $c->author = $name->name;
                    }else{
                        $c->author = "";
                    }
                    
                    $ncomment[] = $c;
                }
            }
    
            $paymentMonth = Payment::where('stud_id', $stud_id)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();
    
            $total_paid_month = 0;
            
            if(count($paymentMonth) != 0) {
                foreach($paymentMonth as $pm) {
                    $total_paid_month += (int)$pm->pay_price;
                }
            }
    
            $total_paid = 0;
    
            if(count($payment) != 0) {
                foreach($payment as $p) {
                    $total_paid += (int)$p->pay_price;
                }
            }
            
            $payment_data = [];
    
            foreach($payment as $pt) {
                $product1 = Product::where('product_id', $pt->product_id);
    
                if($product1->count() > 0){
                    $product1 = $product1->first();
                    $payment_data[] = $product1;
                }
            }
            
            $ticket = Ticket::where('ic', $student_detail['ic'])->get();
            $total_event = count($ticket);
            $data = [];
            
            foreach($ticket as $t) {
                $product = Product::where('product_id', $t->product_id);
    
                if($product->count() > 0){
                    $product = $product->first();
                    $data[] = $product;
                }
            }
    
            return view('studentportal.dashboard', compact('student_detail', 'payment', 'data', 'total_paid', 'total_event', 'member_lvl', 'total_paid_month', 'payment_data', 'ncomment'));
           
        }
         // return view('studentportal.dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
