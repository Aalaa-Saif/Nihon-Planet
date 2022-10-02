@extends('layouts.main-app')
@section('content')
    <div class="container my-4">
        <!-- Images used to open the lightbox -->
        <div class="row">
          <div class="column">
            <img src="{{ asset('img/ni.jpg') }}" onclick="openModal();currentSlide(1)" style="width:200px;" class="hover-shadow">
          </div>
          <div class="column">
            <img src="{{ asset('img/my Hero.jpg') }}" onclick="openModal();currentSlide(2)" style="width:200px;" class="hover-shadow">
          </div>
          <div class="column">
            <img src="{{ asset('img/ni.jpg') }}" onclick="openModal();currentSlide(3)" style="width:200px;" class="hover-shadow">
          </div>
          <div class="column">
            <img src="{{ asset('img/my Hero.jpg') }}" onclick="openModal();currentSlide(4)" style="width:200px;" class="hover-shadow">
          </div>
        </div>

        <!-- The Modal/Lightbox -->
        <div id="myModal" class="modal">
          <span class="close cursor" onclick="closeModal()">&times;</span>
          <div class="modal-content">

            <div class="mySlides">
              <div class="numbertext">1 / 4</div>
              <img src="{{ asset('img/ni_wide.jpg') }}" style="width:100%">
            </div>

            <div class="mySlides">
              <div class="numbertext">2 / 4</div>
              <img src="{{ asset('img/my Hero_wide.jpg') }}" style="width:100%">
            </div>

            <div class="mySlides">
              <div class="numbertext">3 / 4</div>
              <img src="{{ asset('img/ni_wide.jpg') }}" style="width:100%">
            </div>

            <div class="mySlides">
              <div class="numbertext">4 / 4</div>
              <img src="{{ asset('img/my Hero_wide.jpg') }}" style="width:100%">
            </div>

            <!-- Next/previous controls -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <!-- Caption text -->
            <div class="caption-container">
              <p id="caption"></p>
            </div>

            <!-- Thumbnail image controls -->
            <div class="column">
              <img class="demo" src="{{ asset('img/ni.jpg') }}" onclick="currentSlide(1)" alt="Nature">
            </div>

            <div class="column">
              <img class="demo" src="{{ asset('img/my Hero.jpg') }}" onclick="currentSlide(2)"  alt="Snow">
            </div>

            <div class="column">
              <img class="demo" src="{{ asset('img/ni.jpg') }}" onclick="currentSlide(3)"  alt="Mountains">
            </div>

            <div class="column">
              <img class="demo" src="{{ asset('img/my Hero.jpg') }}" onclick="currentSlide(4)"  alt="Lights">
            </div>
          </div>
        </div>
    </div>

@endsection

