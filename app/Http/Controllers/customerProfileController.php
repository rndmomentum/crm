<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Package;
use App\Student;
use App\Payment;
use App\Ticket;
use App\Membership_Level;
use App\Comment;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;

class customerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function customerAddComment($cust_id, Request $request) {
        $customer = Student::where('id', $cust_id)->first();
        
        $comment = Comment::create([
            'stud_id' => $customer['stud_id'],
            'comment' => $request->comment,
            'add_user' => Auth::user()->user_id
        ]);
        
        if($comment) {
            return redirect('customer_profiles/'.$cust_id)->with('commentSuccess', 'Comments Added Successfully!');
        }else {
            return redirect('customer_profiles/'.$cust_id)->with('commentError', 'There is a problem on adding comment!');
        }
    }

    public function customerUpdate($cust_id, Request $request) {
        $customer = Student::where('id', $cust_id)->update(['isSubscribe' => $request->subs]);

        if($customer) {
            return redirect('customer_profiles/'.$cust_id)->with('subsSuccess','Customer Subscribe Updated!');
        } else {
            return redirect('customer_profiles/'.$cust_id)->with('subsError','There is a problem on updating customer subscribe!');
        }
    }
	
	public function customerProfiles(Request $request) {
        $search = $request->query('search');

        if($search) {
            $customers = Student::where('first_name', 'LIKE', '%'.$search.'%')
            ->whereNotNull('membership_id')
            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
            ->orWhere('ic', 'LIKE', '%'.$search.'%')
            ->paginate(10);

        }else {
            $customers = Student::whereNotNull('membership_id')->paginate(10);
        }
        
        return view('customer.customer_profiles', compact('customers'));
    }

    public function customerProfile($id, Request $request) {
        $customer = Student::where('id', $id)->first();
        
        $payment = Payment::where('stud_id', $customer['stud_id'])
        ->orderBy('created_at', 'DESC')
        ->get();

        $member_lvl = Membership_Level::where('level_id', $customer->level_id)->first()->name;
        $comment = Comment::where('stud_id', $customer['stud_id'])->get();
		
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

        $paymentMonth = Payment::where('stud_id', $customer['stud_id'])
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
        
        $ticket = Ticket::where('ic', $customer['ic'])->get();
        $total_event = count($ticket);
        $data = [];
        
        foreach($ticket as $t) {
            $product = Product::where('product_id', $t->product_id);

            if($product->count() > 0){
                $product = $product->first();
                $data[] = $product;
            }
        }
        
        return view('customer.customer_profile', compact('customer', 'payment', 'data', 'total_paid', 'total_event', 'member_lvl', 'total_paid_month', 'payment_data', 'ncomment'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
