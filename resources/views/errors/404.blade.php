@extends('site.layouts.app')
@section('content')
          <main>
               <section class="information-section">
                    <div class="container"> 
                         <div class="error">
                              <h1 class="error__title">Էջը չի գտնվել</h1>
                              <div class="error-position">
                                   <p class="error-text">Էջը, որը փորձում եք գտնել, գոյություն չունի կամ տեղափոխվել է:
                                        Փորձեք վերադառնալ գլխավոր էջ։</p>
                                   <img class="img" src="{{asset('image/error.png')}}" alt="error.png">
                                   <a href="/" class="error__btn button" disabled="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20">
                                             <path id="Union_35" data-name="Union 35" d="M6.186,20V13.913h6.186V20Zm6.628-6.956V6.957H19v6.087ZM0,13.044V6.957H6.186v6.087ZM6.186,6.087V0h6.186V6.087Z" fill="#fff"></path>
                                        </svg>
                                        Գլխավոր Էջ
                                   </a>
                              </div>
                         </div>
                    </div>
               </section>
          </main>
@endsection
