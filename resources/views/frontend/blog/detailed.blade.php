@extends('layouts.talent') @section('content')
<style>
.extra-str {
font-size: 46px !important;
line-height: 49px !important;
font-family: Overpass, sans-serif;
font-weight: 600!important;
}
</style>
<!-- banner start -->
<section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url({{ asset('assets/images/blog-list-banner-one.png')}});">
   <div class="opacity-medium bg-extra-dark-gray"></div>
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
            <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
               <!-- start page title -->
               <p class="alt-font text-white font-weight-700 mb-2 extra-str">FutureStarr</p>
               <!-- end page title -->
               <!-- start sub title -->
               <span class="display-block text-white opacity6 alt-font">
               {{ $blogData->title }}
               </span>
               <!-- end sub title -->
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End banner  -->
<!-- start post content section -->

<section>
   <div class="container">
   <div class="row">
      <main class="col-md-8 col-lg-9 mb-5 detail-blog-secss">
         <div class="text-extra-dark-gray margin-20px-bottom alt-font text-uppercase text-large font-weight-600 ">
            <h1 class="aside-title margin-0">{{ $blogData->title }}</h1>
         </div>
         <div class="blog-details-da border-all blog-details-text last-paragraph-no-margin">
            @if(!empty($blogData->blog_img)) 
            <img src="{{ asset($blogData->blog_img)}}" style="width: 100%;
               height: 400px;
               object-fit: cover;padding:15px;" alt="{{$blogData->alt}}"/>
            @else 
            <img style="height: 400px !important;width:1500px !important;"src="{{ asset('assets/images/defaultblog.png')}}" alt="Blog Banner"/>
            @endif
            <!-- <div class="blog-image pt-2">  
               <a href="">                               
                    <iframe width="400px" height="400px"  class="embed-responsive-item width-100" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>                              
               </a>
               
               </div> -->
            <p class="pl-2 pr-2">
               {!! $blogData->content !!}
            </p>
         </div>
         <div class="col-md-12 blog-sectionss social-icon-style-6 text-center border-all pt-5 border-top-none">
            <h2 class="pb-4">Share Article</h2>
            <ul class="extra-small-icon pb-4 sharebut">
               <li class="pl-3 pr-3">
                  <a class="facebook customer share" href="http://www.facebook.com/sharer.php?u={{Request::url()}}" shareButton="facebook" >
                  <i class="fa fa-facebook"></i>
                  </a>
               </li>
               <li class="pl-3 pr-3">
                  <a class="twitter customer share" href="http://twitter.com/share?text=share&url={{Request::url()}}&amp;text=Share talent &amp;hashtags=FutureStarr
                     " target="_blank" >
                  <i class="fa fa-twitter"></i>
                  </a>
               </li>
               <li class="pl-3 pr-3">
                  <a class="linkedin customer share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{Request::url()}}" target="_blank">
                  <i class="fa fa-linkedin"></i>
                  </a>
               </li>
               
            </ul>
         </div>
         <div class="col-md-12 blog-sectionss border-all padd-15">
            <h2 class="pb-4 text-center">Related Articles</h2>
            <div class="demo">
               <ul id="lightSlider2">
                  @if(count($relatedBlogs) > 0)
                  @foreach($relatedBlogs as $key => $blog)
                  <li>
                     <div class="col-md-12 col-sm-12 blog-rela" style="padding:0px;">
                        <div class="card mb-2">
                           <img alt="Related Blog Image" style="width: 100%;
                              height: 300px;
                              object-fit: cover;" alt="Futurestarr Banner" class="p-4" src="{{asset( !empty($blog->blog_img) && file_exists($blog->blog_img) ? $blog->blog_img:'assets/images/default-ad-banner.png')}}" />
                           <div class="card-body">
                              <h4 class="card-title">{{ $blog->title ?: '' }}</h4>
                              <p style="margin: 15px 5px;" class="card-text">{!! Str::limit(strip_tags($blog->content), 105) !!}</p>
                              <a href="{{ route('blog.detailed', [ $blog->getBlogCatagories['slug'], $blog->slug] ) }}" class="btn btn-primary">Read More</a>
                           </div>
                           <div class="col-md-12 border-top padd-15">
                              <div class="dt-au-lestar col-xs-2 col-md-3 star-author text-medium-gray text-extra-small text-uppercase alt-font">
                                 <img class="au-img-au" src="{{asset( !empty($blog->author_image) && file_exists($blog->author_image) ?  str_replace(' ', '%20', $blog->author_image):'assets/images/aside-image-4.jpg')}}" alt="Author Profile Image">                                 
								
                              </div>
                              <div class="dt-au-le col-md-9 col-xs-9 txt-sm-f pt-5  text-left text-medium-gray text-extra-small text-uppercase alt-font">
                                {{ \Carbon\Carbon::parse($blog->date)->format('F d, Y')}}  &nbsp &nbsp  | &nbsp &nbsp
                                 <a href="javascript:void(0);" class="text-medium-gray margin-15px-top"> {{ $blog->author_first_name ?: '' }}  </a> 
                                 <a href="javascript:void(0);" class="text-medium-gray margin-15px-top"> {{ $blog->author_last_name ?: ''  }} </a> 
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
                  @endforeach
                  @else
                  <p class="text-danger text-center">
                     Sorry, Related article Found!
                  </p>
                  @endif
               </ul>
            </div>
          
            <script>
               $('#lightSlider2').lightSlider({
                item: 2,
                loop:true,
                slideMargin: 5,
                useCSS:true,
                pager: true,
                responsive : [
                {
                 breakpoint:991,
                 settings: {
                  item:1,
                  slideMove:1
                }
               }
               ],
               
               });
            </script>
      </main>
      <aside class="col-md-4 col-lg-3">
      <div class="margin-45px-bottom xs-margin-25px-bottom">
      <div class="text-extra-dark-gray margin-20px-bottom alt-font font-weight-600 text-small text-center">
      <h2> Super Star Author</h2>
      </div>     
      <div class="row justify-content-between align-items-center">
      <div class="border-all bgcs">
      <div class="tag-cloud tt-au-data margin-20px-bottom">
      <img class="au-img-dd" src="{{ asset( !empty($blogData['author_image']) && file_exists($blogData['author_image']) ? str_replace(' ', '%20', $blogData->author_image) :'assets/images/aside-image-4.jpg')}}" alt="Author Profile Image">        
	         
      <br/>
      </div>
      <div class=" border-top pl-3 pr-3 pt-2 pb-t text-medium-gray text-small margin-5px-bottom text-uppercase alt-font">
      <a  href="javascript:void(0);"> {{ $blogData['author_first_name'] }} {{ $blogData['author_last_name'] }} <br/>
      <a href="javascript:void(0);">Posted on  {{date('F d , Y' , strtotime($blogData['date']))}}</a> 
      </a> 
      </div>
      <div class="border-top pt-4 social-icon-style-6 text-center">
      <h4 class="pb-4">Share Article</h4>
      <ul style="width: 100% !important;" class="extra-small-icon">
      <li class="pl-3 pr-3">
      <a class="facebook customer share" href="http://www.facebook.com/sharer.php?u={{Request::url()}}" shareButton="facebook" >
      <i class="fa fa-facebook"></i>
      </a>
      </li>
      <li class="pl-5 pr-3">
      <a class="twitter customer share" href="http://twitter.com/share?text=share&url={{Request::url()}}&amp;text=FutureStarr Blog by Star author &amp;hashtags={{ $blogData['author_first_name'] }}{{ $blogData['author_last_name'] }}" target="_blank" >
      <i class="fa fa-twitter"></i>
      </a>
      </li>
      <li class="pl-5 pr-3">
          
         <a class="linkedin customer share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{Request::url()}}" target="_blank" target="_blank">
                  <i class="fa fa-linkedin"></i>
                  </a>
         
      </li>
      
      
      </ul>
      </div>
      </div>
      <div class="border-all bgc">
      <div class="blog-details-comments" *ngIf="blogComment && blogComment.length>0">
      <div class="width-100 margin-lr-auto text-center margin-four-tb sm-margin-50px-tb xs-margin-30px-tb">
      <div class="position-relative overflow-hidden width-100">
      <span class="text-medium text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray">{{ count($blogData->getBlogComments) }}
      Comments</span>
      </div>
      </div>
      <ul class="blog-comment">
      @if(count($blogData->getBlogComments) > 0)
      @foreach($blogData->getBlogComments as $blogComment)
      <li>
      <div class="display-table width-100">
      <div class="display-table-cell width-100px xs-width-50px text-center vertical-align-top xs-display-block xs-margin-10px-bottom border-all">
      <a href="javascript::void(0)" target="_blank">
      @if(!empty($blogComment->getCommentUser['profile_pic'])  && file_exists($blogComment->getCommentUser['profile_pic']))
      <img class="rounded-circle width-85 xs-width-100" src="{{ asset($blogComment->getCommentUser->profile_pic) }}" alt="Profile Pic">
      @else 
      <img class="rounded-circle width-85 xs-width-100" src="{{ asset('assets/images/profile.png') }}" alt="Profile Pic">
      @endif
      </a>
      </div>
      <div class="border-all padding-20px-left display-table-cell vertical-align-top last-paragraph-no-margin xs-no-padding-left xs-display-block margin-30px-bottom">
      {{ $blogComment->getCommentUser['first_name'] }} {{ $blogComment->getCommentUser['last_name'] }}
      <!-- <a href="#comments"
         class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Reply</a> -->
      <div class="text-small text-medium-gray text-uppercase margin-10px-bottom">{{ date('F d, Y' , strtotime($blogComment->created_at)) }}</div>
      <p>{{ $blogComment->message }}</p>
      </div>
      </div>
      </li>
      @endforeach
      @else
      <li>No Comment Found!!</li>
      @endif
      </ul>
      </div>
      <div class="margin-lr-auto pl-2 pr-2 text-center margin-four-tb sm-margin-50px-tb xs-margin-30px-tb">
      <div class="position-relative overflow-hidden width-100">
      <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray">Write
      A Comment</span>
      </div>
      </div>
      <form class="pl-3 pr-3 pb-4" action="{{ route('comment.blog')}}" method="POST">
      @csrf
      <div class="row">
      <div class="col-md-12">
      <textarea placeholder="Enter your comment here.." rows="8" class="medium-textarea form-control" name="message" required></textarea>
      @error('name')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
      </div>
      <div class="col-md-12 text-center">
      <input type="hidden" name="category_id" value="{{ Request::segment(3) }}">
      <input type="hidden" name="blog_id" value="{{$blogData->id}}">
      @if($check =='true')
      <button class="btn btn-dark-gray btn-small margin-15px-top" type="submit">Send message</button>
      @else
      <button type="button" class="btn btn-dark-gray btn-small margin-15px-top" data-toggle="modal" data-target="#register_my_model">Send message</button>
      @endif
      </div>
      </div>
      </form>
      </div>
      </div>
      </div>
      <div class="diamond-div">
        <img style="display: block; margin: auto;" src="{{ asset('/assets/images/diamond.png') }}">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#web_link_model">ADD YOUR WEBSITE HERE!</a>
      </div>
      </aside>
      </div>
   </div>
</section>
<!-- end blog content section -->
<!-- ASK TO LOGIN -->
  <div id="web_link_model" class="modal modal-m" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" style="color: #000 !important;">&times;</button>
            <div class="content">
              <img src="{{ asset('assets/images/user-link-img.png') }}">
              <p class="head">Add your company website/link</p>
              <p class="text">to this blog page for only <span>$40</span> Purchase now!</p>
              <a href="javascript:void(0)" class="cont-btn" data-toggle="modal" data-target="#web_link_model_form" data-dismiss="modal">Continue</a>
            </div>
          </div>
         </div>
      </div>
   	</div>
    <div id="web_link_model_after_submit" class="modal modal-m" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" style="color: #000 !important;">&times;</button>
            <div class="content">
              <img style="width: 108px; margin: auto; display: block;" src="{{ asset('/images/loading.gif') }}">
              <h4 class="mt-5">Processing...</h4>              
            </div>
          </div>
         </div>
      </div>
   </div>
     <div id="web_link_model_form" class="modal modal-m" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" style="color: #000 !important;">&times;</button>
            <div class="content">
              <h2>Website link info</h2>
              <form>
                <input type="hidden" name="blog_id" id="blog_id_x" value="{{$blogData->id}}">
                <div class="form-group">
                  <label>Anchor Text</label>
                  <input type="text" name="anchor" id="anchor" placeholder="Anchor Text">
                </div>
                <div class="form-group">
                  <label>Website</label>
                  <input type="text" name="website" id="website" placeholder="Website">
                </div>
                <div class="form-group">
                  <label>Copy/Paste FutureStarr blog url</label>
                  <input type="text" name="link" id="link" placeholder="Copy/Paste FutureStarr blog url">
                </div>
                <div class="form-group">
                  <label style="cursor: pointer; font-size: 14px;"><input type="checkbox" name="term" id="term" style="width: auto;"> Terms: We do not accept links from "Adult sites, Gambling, Affiliate marketing, Erotica or Violent sites". All links must be relative to the article page.</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>             
            </div>
          </div>
         </div>
      </div>
   </div>
   <style type="text/css">
      .diamond-div{
      display: block;
      margin: 20px auto;
     }
    .diamond-div a{
      display: block;
      background: #f5e315;
      text-align: center;
      padding: 12px 0;
      font-weight: 600;
      color: #000000;
      border-radius: 8px;
      font-size: 15px;
      margin-top: 20px;
     }
      #web_link_model_form .content{
      padding: 30px;
      margin: auto;
     }
     #web_link_model_after_submit .content{
     	padding: 40px;
     	margin:auto;
     }
     #web_link_model_form .content h2{
            margin-bottom: 27px !important;
    font-size: 25px;
    color: #777;
    font-weight: 500;
    letter-spacing: 1px;
     }
     #web_link_model_form .content label{
          font-size: 16px;
    font-weight: 500;
     }
     #web_link_model_form .content input{
      margin-bottom: 0;
     }
     #web_link_model .content{
      padding: 40px 30px 30px 30px;
      margin: auto;
     }
     #web_link_model img{
        display: block;
        width: 150px;
        margin: auto;
     }
     #web_link_model .content .head{
      font-size: 22px !important;
      text-align: center;
      margin-top: 20px;
     }
     #web_link_model .content .text{
      text-align: center;
     }
     #web_link_model .content .text span{
      color: #ff0000;
     }
     #web_link_model .content .cont-btn{
      background: #ff0000;
      color: #ffffff;
      padding: 8px 15px;
      border-radius: 6px;
      margin: 30px auto auto;
      width: 102px;
      display: block;
      text-align: center;
     }
   </style>
<div class="modal-ask-to-login fade" id="askToLogin" role="dialog">
   <div class="modal-dialog">
      <form>
         <!-- Modal content-->
         <div class="ask-to-login">
            <div class="modal-body">
               <div class="form-group text-spinner">
                  <h3 class="deleteConfirmation">Please login to use this feature! </h3>
                  <i class="fa fa-circle-o-notch fa-spin"></i>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- Ask to join as Seller -->
<div class="container">
   <!-- Modal -->

   <div id="register_my_model" class="modal  modal-m" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header mob-cls" style="padding:5px;">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style=" position: relative; padding-top: 0px; padding-left: 15px; padding-right: 15px;padding-bottom: 0px;">
               <div class="row">
                  <div class="col-sm-5 text-center login-back" style="background-color:#fff;">
                     <h4 style="color:#ff503f;font-weight: 600;margin: 54px 0 0 0;">
                        Awe, looks like you have not 
                     </h4>
                     <h4 style="color:#ff503f;font-weight: 600;text-align: center;">signed up for Future Starr.</h4>
                     <p style="margin: 34px 0 0 0; text-align: center;"><b>No worries, click the Register</b></p>
                     <p style="text-align: center;"><b>button and sign up now for FREE!</b></p>
                     <a routerLink="/register" class="btn btn-danger" style="margin-bottom: 30px;" (click)="model_toggle()">Register</a>
                  </div>
                  <div class="col-sm-7 text-center login-back-img" style="height: auto;background-image:url({{ asset('assets/images/new_pop_up.jpg')}});background-size:cover;background-position:left;">
                     <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
                     <br><br><br><br><br><br>
                     <p style="color:#fff;"></p>
                     <h3 style="color:#fff;"></h3>
                     <p style="color:#fff;"></p>
                     <br><br>  <br><br><br><br><br>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<a class="scroll-top-arrow" href="javascript:void(0);"><i   class="ti-arrow-up"></i></a>
@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script type="text/javascript">   
   ;(function($){
    
     /**
     * jQuery function to prevent default anchor event and take the href * and the title to make a share popup
     *
     * @param  {[object]} e           [Mouse event]
     * @param  {[integer]} intWidth   [Popup width defalut 500]
     * @param  {[integer]} intHeight  [Popup height defalut 400]
     * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
     */
     $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
      
     // Prevent default anchor event
     e.preventDefault();
     
     // Set values for window
     intWidth = intWidth || '500';
     intHeight = intHeight || '400';
     strResize = (blnResize ? 'yes' : 'no');
     
     // Set title and open popup with focus on it
     var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
     strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
     objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
   }
   
   /* ================================================== */
   
   $(document).ready(function ($) {
     $('.customer.share').on("click", function(e) {
      $(this).customerPopup(e);
    });
   });
   
   }(jQuery));
</script>
@stop