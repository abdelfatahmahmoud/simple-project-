
@extends('layouts.master')

@section('content')

   <div class="row " >
       <div class="col-md-6 offset-md-2">
           <div class="card mb-3" style="min-width: 18rem;">

           <div class="card-body">
               <div class="card-title">
                   <h4> {{$post->title}}</h4>
               </div>

               <div class="card-text">
                   {{$post->body}}
               </div>

               <img src="{{asset('images/coverImages/'.$post->image)}}" alt="" height="200" width="400">

               <hr>
               <small class="text-muted"><p>{{$post->created_at}}</p></small>
               <p class="alert alert-primary font-weight-bold badge-light">created By: {{$post->user->name}}</p>
               @auth()
                   @if(auth()->user()->id == $post->user_id)

               <a href="{{ '/posts/' . $post->id . '/edit'}}" class="btn btn-primary float-left mr-2"> Edit</a>
               <form action="{{route('posts.destroy', ['id' => $post->id])}}" method="POST">

                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-danger float-left"> Delete</button>

               </form>
                   @endif
               @endauth
           </div>
       </div>
       </div>
   </div>

@endsection
