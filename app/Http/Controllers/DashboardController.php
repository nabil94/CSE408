<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;
use App\Notification;
use DB;

class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
    //   $posts= Post::where('booking','booked')->get();


    //   $posts = Post::where([['booking', '=', 'booked'],['user_id', '=', $user_id],])->get();



         //$posts=DB::table('posts')->where('id','LIKE','%'.$user_id.'%');
        //return view('dashboard')->with('posts',$posts);
        return view('dashboard')->with('posts',$user->posts);
       //  return view('dashboard',['posts'=>$user->posts]);
    }


    public function requestroom(Request $request)
    {
         $user_id=auth()->user()->id;
        $posts = Post::where([['booking', '=', 'pending'],['user_id', '=', $user_id]])->get();
        return view('requestroom')->with('posts',$posts);
    }

    public function notify(Request $request)
    {
       $user_id=auth()->user()->id;
       $posts = Notification::where([['guest_id', '=', $user_id]])->get();
       return view('notification')->with('posts',$posts);
    }

    public function logs(Request $request)
    {
       $userid=auth()->user()->id;
       $posts = Notification::where([['user_id', '=', $userid]])->get();
       $psts = Post::where([['user_id', '=', $userid]])->get();
       $pp = Post::where([['hostid', '=', $userid]])->get();
       return view('workinglog')->with('posts',$posts)->with('psts',$psts)->with('pp',$pp);
    }

    public function confirmroom($id)
    {
         $post= Post::find($id);
        DB::table('room_book')->insert(
            ['rid' => $post->id, 'taken' => $post->hostid,'from_date' => $post->requested_from_date,'to_date'=>$post->requested_to_date]);
        DB::table('notification')->insert(
           ['user_id' => auth()->user()->id, 'user_name' => auth()->user()->name, 'guest_id' => $post->hostid, 'guest_name' => $post->hostname, 'room_id' => $post->id, 'room_name' => $post->title, 'status' => 'confirm']);
        $post->booking="booked";
        $post->save();
        return redirect('/dashboard/requestroom');
    }


    public function cancelroom($id)
    {
        $post= Post::find($id);
        DB::table('notification')->insert(
           ['user_id' => auth()->user()->id, 'user_name' => auth()->user()->name, 'guest_id' => $post->hostid, 'guest_name' => $post->hostname, 'room_id' => $post->id, 'room_name' => $post->title, 'status' => 'cancel']);
        //$post->booking="booked";
        $post->booking="";
        $post->hostname="";
        $post->hostid="";
        $post->save();
        return redirect('/dashboard/requestroom');

    }


    public function occupiedroom(Request $request)
    {
        $ind=0;
        $cposts = array();
        $nposts = array();

        $user_id=auth()->user()->id;
        $posts = Post::where([['booking', '=', 'booked'],['user_id', '=', $user_id]])->get();
        foreach($posts as $p){
             $cposts[]=$p->id;
             $nposts[]=$p->hostname;
         }

        $ind=$ind+1;
        return view('occupiedroom')->with('posts',$posts);
    }


    public function hasRoom(Request $request)
    {
      $ind=0;

      $user_id=auth()->user()->id;
      $posts = Post::where([['booking', '=', 'booked'],['hostid', '=', $user_id]])->get();

      return view('hasRoom')->with('posts',$posts);


    }
    /*public function ProfileUpdate(Request $request, $id)
    {
        //
         $this->validate($request,['phone_number'=>'required','nid'=>'required']);

        //create post
        $post=User::find($id);
        $post->title=$request->input('phone_number');
        $post->body=$request->input('nid');
        $post->save();
        return redirect('/profile')->with('success','Profile updated');
    }*/




}
