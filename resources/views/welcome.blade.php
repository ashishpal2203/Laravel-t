

@extends("layout")

@section("content")

<div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="https://media.istockphoto.com/id/490736905/photo/meenakshi-hindu-temple-in-madurai-tamil-nadu-south-india.jpg?s=612x612&w=0&k=20&c=OlOLvdryIdkdyKcY9gRPsM1RZa5HiP6QBr2JVAIvPb0=" alt="" width="72" height="57">
    <h1 class="display-5 fw-bold">Assessment Test</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">we're more than just a team of developers. We're creators, innovators, and problem solvers dedicated to turning your vision into a digital masterpiece.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
       <a href="{{ url("/register") }}"> <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Register here</button></a>
      </div>
    </div>
  </div>


@endsection
