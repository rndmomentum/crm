<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Product;
use App\Package;
use App\Payment;
use App\Ticket;
use App\Exports\ProgramExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\PengesahanJob;
use App\Jobs\TiketJob;

class ReportsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ReportsController
    |--------------------------------------------------------------------------
    |   This controller is for managing the sales report
    | 
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function trackcustomer()
    // {
    //     $student = Student::orderBy('id','desc')->paginate(15);
    //     $product = Product::orderBy('id', 'desc')->get();
         
    //     $totalcust = Student::count();
    //     $totalpay = Payment::count();

    //     return view('admin.reports.trackcustomer', compact('student','product','totalcust','totalpay'));
    // }

    public function trackprogram(Request $request)
    {
        // $q = $request->search;
        // $product = Product::where('name', 'LIKE', '%' . $q . '%')
        // ->orWhere('product_id', 'LIKE', '%' . $q . '%')
        // ->paginate(15);
        // $product->appends(['search' => $q]);

        $student = Student::orderBy('id','desc')->get();
        $product = Product::orderBy('id','desc')->paginate(15);
        $package = Package::orderBy('id','asc')->get();
        $payment = Payment::orderBy('id','asc')->get(); 

        $totalcust = Student::count();
        $totalpay = Payment::count();
        
        return view('admin.reports.trackprogram', compact('student','product','package', 'payment', 'totalcust','totalpay'));
    }

    public function trackpackage($product_id)
    {
        $payment = Payment::where('product_id', $product_id)->get();
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('product_id', $product_id)->paginate(15);
        $student = Student::orderBy('id','desc')->paginate(15);

        $counter = Student::count();
        $totalsuccess = Payment::where('status','paid')->where('product_id', $product_id)->count();
        $totalcancel = Payment::where('status','due')->where('product_id', $product_id)->count();
        $paidticket = Ticket::where('ticket_type', 'paid')->where('product_id', $product_id)->count();
        $freeticket = Ticket::where('ticket_type', 'free')->where('product_id', $product_id)->count();
        // $count_package = Payment::where('product_id', $product_id)->count();
        
        // dd($student);
        return view('admin.reports.trackpackage', compact('product', 'package', 'payment', 'student', 'counter', 'totalsuccess', 'totalcancel', 'paidticket', 'freeticket'));
    }

    public function viewbypackage($product_id, $package_id)
    {
        //Get the details
        $payment = Payment::orderBy('id','desc')->where('product_id', $product_id)->where('package_id', $package_id)->paginate(15);
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $student = Student::orderBy('id','desc')->get();

        //Count the data
        $count = 1;
        $total = Payment::where('product_id', $product_id)->where('package_id', $package_id)->count();
        $totalsuccess = Payment::where('status','paid')->where('product_id', $product_id)->where('package_id', $package_id)->count();
        $totalcancel = Payment::where('status','due')->where('product_id', $product_id)->where('package_id', $package_id)->count();
        $paidticket = Ticket::where('ticket_type', 'paid')->where('product_id', $product_id)->where('package_id', $package_id)->count();
        $freeticket = Ticket::where('ticket_type', 'free')->where('product_id', $product_id)->where('package_id', $package_id)->count();
        
        return view('admin.reports.viewbypackage', compact('product', 'package', 'payment', 'student', 'count', 'total', 'totalsuccess', 'totalcancel', 'paidticket', 'freeticket'));
    }

    public function destroy($payment_id, $product_id, $package_id) 
    {
        $payment = Payment::where('payment_id', $payment_id)->where('product_id', $product_id)->where('package_id', $package_id);
        $ticket = Ticket::where('payment_id', $payment_id)->where('product_id', $product_id)->where('package_id', $package_id);
        // dd($payment);

        $payment->delete();
        $ticket->delete();

        return back()->with('deletepayment', 'Payment Successfully Deleted');
    }

    public function save_customer($product_id, $package_id, Request $request)
    { 
        $student = Student::where('ic', $request->ic)->first();
        
        if(Student::where('ic', $request->ic)->exists()){

            $payment_id = 'OD'.uniqid();

            Payment::create(array(
                'payment_id'=> $payment_id,
                'pay_price'=> $request->pay_price,
                'totalprice'=> $request->totalprice,
                'quantity' => $request->quantity,
                'status' => 'paid',
                'pay_method' => 'FPX',
                'stud_id' => $student->stud_id,
                'product_id' => $product_id,
                'package_id' => $package_id,
                'offer_id' => 'Import'
            ));

            // $ticket_id = 'TIK' . uniqid();

            // Ticket::create([
            //     'ticket_id'     => $ticket_id,
            //     'ticket_type'   => $request->ticket_type,
            //     'ic'            => $request->ic,
            //     'product_id'    => $product_id,
            //     'package_id'    => $package_id,
            //     'payment_id'    => $payment_id
            // ]);

        }else{

            $stud_id = 'MI'.uniqid();
            
            Student::create(array(
                'stud_id'=> $stud_id,
                'first_name'=> $request->first_name,
                'last_name'=> $request->last_name,
                'ic' => $request->ic,
                'phoneno' => $request->phoneno,
                'email' => $request->email
            ));

            $payment_id = 'OD'.uniqid();

            Payment::create(array(
                'payment_id'=> $payment_id,
                'pay_price'=> $request->pay_price,
                'totalprice'=> $request->totalprice,
                'quantity' => $request->quantity,
                'status' => 'paid',
                'pay_method' => 'FPX',
                'stud_id' => $stud_id,
                'product_id' => $product_id,
                'package_id' => $package_id,
                'offer_id' => 'Import'
            ));

            // $ticket_id = 'TIK' . uniqid();

            // Ticket::create([
            //     'ticket_id'     => $ticket_id,
            //     'ticket_type'   => $request->ticket_type,
            //     'ic'            => $request->ic,
            //     'product_id'    => $product_id,
            //     'package_id'    => $package_id,
            //     'payment_id'    => $payment_id
            // ]);
        }

        return redirect('viewbypackage/'.$product_id.'/'.$package_id)->with('addsuccess','Customer Successfully Added!');
    }

    public function trackpayment($product_id, $package_id, $payment_id, $student_id)
    {
        $paginate = Payment::where('product_id', $product_id)->paginate(15);
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $payment = Payment::where('payment_id', $payment_id)->first();
        $student = Student::where('stud_id', $student_id)->first();

        $counter = Student::count();
        
        // dd($payment);
        return view('admin.reports.trackpayment', compact('paginate', 'product', 'package', 'payment', 'student', 'counter'));
    }

    public function updatepayment($product_id, $package_id, $payment_id, $student_id, Request $request)
    {
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $payment = Payment::where('payment_id', $payment_id)->first();
        $student = Student::where('stud_id', $student_id)->first();

        $student->ic = $request->ic;
        $student->phoneno = $request->phoneno;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->save();

        $payment->status = $request->status;
        $payment->save();

        return redirect('viewbypackage/'.$product_id.'/'.$package_id)->with('updatepayment','Customer Successfully Updated!');
    }

    public function exportProgram($product_id)
    {
        $payment = Payment::where('product_id', $product_id)->get();
        $student = Student::orderBy('id','desc')->get();
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('product_id', $product_id)->get();

        return Excel::download(new ProgramExport($payment, $student, $package), $product->name.'.xlsx');
    }

    // search method
    public function search($product_id, $package_id, Request $request)
    {   
        // $payment = Payment::orderBy('id','desc')->where('product_id', $product_id)->where('package_id', $package_id)->paginate(15);
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $student = Student::orderBy('id','desc')->get();

        //Count the data
        $count = 1;
        $total = Payment::where('product_id', $product_id)->where('package_id', $package_id)->count();
        $totalsuccess = Payment::where('status','paid')->where('product_id', $product_id)->where('package_id', $package_id)->count();
        $totalcancel = Payment::where('status','due')->where('product_id', $product_id)->where('package_id', $package_id)->count();
        $paidticket = Ticket::where('ticket_type', 'paid')->where('product_id', $product_id)->where('package_id', $package_id)->count();
        $freeticket = Ticket::where('ticket_type', 'free')->where('product_id', $product_id)->where('package_id', $package_id)->count();

        //get details from search
        $student_id = Student::where('ic', $request->search)->orWhere('first_name', $request->search)->orWhere('last_name', $request->search)->orWhere('email', $request->search)->first();
        $stud_id = $student_id->stud_id;

        if ($stud_id->isEmpty()){

            return redirect()->back()->with('search-error', 'Customer not found!');

        }else{
            
            $payment = Payment::where('stud_id','LIKE','%'. $stud_id.'%')->get();

            if(count($payment) > 0)
            {
                return view('admin.reports.viewbypackage', compact('product', 'package', 'payment', 'student', 'count', 'total', 'totalsuccess', 'totalcancel', 'paidticket', 'freeticket'));

            }else{

                return redirect()->back()->with('search-error', 'Customer not found!');

            }
        }
    }

    public function purchased_mail($product_id, $package_id, $payment_id, $student_id)
    {
        /*-- Manage Email ---------------------------------------------------*/

        $payment = Payment::where('payment_id', $payment_id)->where('product_id', $product_id)->where('package_id', $package_id)->first();
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $student = Student::where('stud_id', $student_id)->first();

        $send_mail = $request->email;
        $product_name = $product->name;        
        $date_from = $product->date_from;
        $date_to = $product->date_to;
        $time_from = $product->time_from;
        $time_to = $product->time_to;
        $packageId = $package_id;
        $payment_id = $payment->payment_id;
        $productId = $product_id;        
        $student_id = $student->stud_id;

        echo 'sent mail';

        // dispatch(new PengesahanJob($send_mail, $product_name, $date_from, $date_to, $time_from, $time_to, $packageId, $payment_id, $productId, $student_id));

        // return redirect()->back()->with('purchased-sent', 'Purchased confirmation email has been sent successfully') ;
    }

    public function updated_mail($product_id, $package_id, $payment_id, $student_id)
    {
        $payment = Payment::where('payment_id', $payment_id)->where('product_id', $product_id)->where('package_id', $package_id)->first();
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $student = Student::where('stud_id', $student_id)->first();

        $email = $request->email; 
        $product_name = $product->name;
        $date_from = $product->date_from;
        $date_to = $product->date_to;
        $time_from = $product->time_from;
        $time_to = $product->time_to;
        $packageId = $package_id;
        $payment_id = $payment->payment_id;
        $productId = $product_id;        
        $student_id = $student->stud_id;
        
        echo 'sent mail';
        
        // dispatch(new TiketJob($email, $product_name, $date_from, $date_to, $time_from, $time_to, $packageId, $payment_id, $productId, $student_id));
        
        // return redirect()->back()->with('updated-sent', 'Updated confirmation email has been sent successfully') ;
    }
}
