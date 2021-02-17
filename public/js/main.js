 function animateValue(id, start, end, duration) {
    if (start === end) return;
    var range = end - start;
    var current = start;
    var increment = end > start? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = document.querySelector(id);
    var timer = setInterval(function() {
        current += increment;
        obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}
var animationElements = [];
$('.ani').each(function(par){
  animationElements.push($(this).children().text());
});

for(i=0;i<animationElements.length; i++)
{
  animateValue('.animate-'+i+'',1,animationElements[i],6000)
  console.log(animationElements[i]);
}
// console.log(animationElements);

$(function(){
let sliderdnow = $('.sliderdnow');

sliderdnow.on('click',function(e){
  // e.preventDefault();
 let xc =$(this).parent().siblings('.original-form').children('.input-denoate').val()  ;
 
   $(this).siblings('.dnow').val(xc)  ;
});

let projectnow = $('.projectnow');

projectnow.on('click',function(e){
  // e.preventDefault();
  let xcp =$(this).parent().siblings('.c_c').val();
//   console.log(xcp);
   $(this).siblings('.dnow').val(xcp)  ;
});
 
 //our project page denoate now
 let oprojecstnow = $('.oprojecstnow');
oprojecstnow.on('click',function(e){
  // e.preventDefault();
  let ourprojectvalue =$(this).parent().siblings('.ourprojectnowvalue').val();
  //  console.log(ourprojectvalue);
   $(this).siblings('.dnow').val(ourprojectvalue)  ;
});
//project detail denoate now
let projectdetail = $('.projectdetail'),
    pvalue = $('.projectdetailvalue'),
    check = $('#check');
    pvalue.on('keyup',function(){

      // console.log($(this).val());
      if($(this).val() != "")
      {
        if(!isNaN($(this).val()))
          check.css('display','inline-block');
        $(this).removeClass('detail-error');
        $(this).addClass('detail-success');
        // $(this).css('border','1px solid green !important');
      }
      else
      {
        $(this).removeClass('detail-success');
        $(this).addClass('detail-error');
        check.css('display','none');
      }
    });
    
projectdetail.on('click',function(e){
  let projectdetailvalue =$(this).parent().siblings().find('.detailForm').children('.projectdetailvalue').val();
   $(this).siblings('.dnow').val(projectdetailvalue)  ;
});

let cpvalue = $('.customprojectdetailvalue');

cpvalue.on('keyup',function(){
  if($(this).val() != "")
  {
    $(this).removeClass('detail-error');
    $(this).addClass('detail-success');
  }
  else
  {
    $(this).removeClass('detail-success');
    $(this).addClass('detail-error');
  }
});

let customProjectdetail = $('.customProjectdetail')
customProjectdetail.on('click',function(e){
  
  let customprojectdetailvalue =$(this).parent().siblings().find('.customDetailForm').children('.customprojectdetailvalue').val();
   $(this).siblings('.dnow').val(customprojectdetailvalue)  ;
});

// // customProjectdetail
// let cpvalue = $('.customprojectdetailvalue');
// cpvalue.on('keyup',function(){
//   if($(this).val() != "")
//   {
//     $(this).removeClass('detail-error');
//     $(this).addClass('detail-success');
//   }
//   else
//   {
//     $(this).removeClass('detail-success');
//     $(this).addClass('detail-error');
//   }
// });

// let customProjectdetail = $('.customProjectdetail')
// customProjectdetail.on('click',function(e){
//   let customprojectdetailvalue =$(this).parent().siblings().find('.customDetailForm').children('.customprojectdetailvalue').val();
//   $(this).siblings('.dnow').val(customprojectdetailvalue)  ;
// });

  //add   arrows  to cart project detail page
  let arrow = $('.arrow .custom-input'),
      c_denoate = $('#c_denoate');

  arrow.on('click',function(e){
    // e.preventDefault();
    c_denoate.val('');
    let v = $(this).children('.arrVal').val();
    c_denoate.val(v)
    if(v==="")
    {return}
   
  }); 
  
  //custom project Detail
let customarrow = $('.arrow .custom-project-detail'),
customprojectdenoate = $('.custom-project_denoate');
//   $(this).parent().siblings('form').find('.c_c').val($(this).children('.arrVal').val())
 
customarrow.on('click',function(e){
e.preventDefault();
 
customprojectdenoate.val('');
let v = $(this).children('.arrVal').val();
$(this).parent().parent().siblings().find('.custom-project_denoate').val(v)
if(v==="")
{return}
}); 
  
 //start our project
   let ourProjectBtn = $('#our-projects-buttons button');
      ourProjectBtn.on('click',function(){
        let btnValue   = $(this).children('.ourArrVal'),
            inputOther = $('.input-denoate');
        let inputValue = $(this).parent().siblings('.our-projects-form').find('.input-denoate');
        inputOther.val('');
        inputValue.val(btnValue.val());
      });
  //end our project
  let _arrow = $('.arrow .custom-input');

  arrow.on('click',function(e){
    // e.preventDefault();
    c_denoate.val('');
    let v = $(this).children('.arrVal').val();
    c_denoate.val(v)
    if(v==="")
    {return}
   
  }); 

  //set active link
   function setLinkActive(elem) 
   {
    path  = window.location.href;
    elem.each(function(){
      if(this.href === path) {
         $(this).parent().removeClass('active')
        $(this).parent().addClass('active');
      } else {
          $(this).parent().removeClass('active');
      }
    });
   }
      //set links active 
      let _link = $('.navbar ul li a');
      setLinkActive(_link);
  
  let _linkdashboard = $('.dashboard .list-group a'),
      pathofdashboard  = window.location.href
  _linkdashboard.each(function(){
    if(this.href === pathofdashboard) {
       $(this).removeClass('active')
      $(this).addClass('active');
    } else {
        $(this).removeClass('active');
    }
  });
  
 
 });

//display whatsapp icon
$(document).on('scroll',function(){
  if ($(document).scrollTop() >= 600) {
    $('.whatsapp-icon').css('display','block');
    // console.log($(document).scrollTop());
  }
});
$(document).ready(function(){

  //fire tooltip
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
  })

  //focus input
  $('#createProject').on('shown.bs.modal',function (){
   $('#inputProjectName').trigger('focus');
  });
  $('.modal').on('shown.bs.modal',function (){
   $('#inputProjectName').trigger('focus');
  });
 
// tabs between sdad and payment account
let card   = $('#pay-opt1'),
    sdad   = $('#pay-opt2'),
    payOp1 = $('#card-form'),
    payOp2 = $('#sdad-form');

    card.on('click',function() {
      // if(payOp1.classlist = )
      // payOp1.addClass('show');
      payOp1.removeClass('hide')
      payOp2.addClass('hide')
      console.log('card');
    });

    sdad.on('click',function() {

      payOp1.addClass('hide')
      payOp2.removeClass('hide')
      // payOp2.addClass('show');/
      console.log('sdad');
    });


let zkat = $('#zkat');
let zkatResult = $('#zkatResult');
let _zkatResult = $('#_zkatResult');
let _add_to = $('#add-to-basket-zakat');
_add_to.on('click',function(e){
  if(_zkatResult.val() < 100 )
  {
    e.preventDefault()
  }

});

  zkat.on('keyup',function(e){
    if(zkat.val() ==='')
    {
      zkat.css('border','2px solid #ff7070')
      zkatResult.val('');
      _zkatResult.val('');
    }
    else
    {
      zkat.css('border','2px solid #2fa89c')
    }

    if(zkat.val() === NaN)
    {
      zkat.css('border','2px solid #ff7070')
      zkatResult.text('0');
      _zkatResult.val('0')
      return  false;
    }
    else if(zkat.val() == 1 )
    {
      zkatResult.text(1/40)
      _zkatResult.val(1/40)
    }
    else if(zkat.val()  > 2 )
    {
      _zkatResult.val(Math.floor(zkat.val() /40))
      zkatResult.text( Math.floor(zkat.val() /40))
    }
    else
    {
      zkat.css('border','2px solid #2fa89c')
    }
    if(Math.floor(zkatResult.text()) < 100 )
    {
      console.log('cant be less than 100')
    }
  });

  let link = $('#link').attr('href'),
    _input = document.createElement("textarea"),
    myText = document.createTextNode('');
  $('._copy').on('click',function(){
      _input.value = "hi"
    console.log(_input.val());
    // document.getElementById('stext').select()
  // $('stext').select();
    // text.select();
    // document.execCommand("copy");
  });
  //remove success message
  $('.success').fadeOut(15000).removeClass('success');
  $('.error').fadeOut(15000).removeClass('error');
  $('#hide-error').fadeOut(15000).removeClass('error');
  // $('.class="rm-after-delete"').fadeOut(6000);
  $('#delete').on('click',function(){
    let _confirm = confirm('لا تجعل الشيطان يمنعك  من التبرع');
    if(_confirm)
      return true;
    else
      return  false;
  });

  let btnDelete = $('.del'),
  _cart_form  = $('._cart_form');
//   console.log(_cart_form.length);
  switch(_cart_form.length) {
    case 0 : $('.cart .content').addClass('fix_0');
    break;
    case 1 : $('.cart .content').addClass('fix_1');
    break;
    case  2 : $('.cart .content').addClass('fix_2');
    break;
    case  3 : $('.cart .content').addClass('fix_3');
    break;
    case  4 : $('.cart .content').addClass('fix_4');
    break;

    // default : 
  }
btnDelete.on('click',function() {
  let _confirm = confirm('لا تجعل الشيطان يمنعك  من التبرع');
    if(_confirm)
      return true;
    else
      return  false;
});

  $('.btn-project').on('click',function(e) {
    var _confirm = confirm('هل تريد حذف العنصر');
    if(_confirm)
      return true;
    else
      return  false;
  });

  $('.btn-slider').on('click',function(e) {
    var _confirm = confirm('هل تريد حذف العنصر');
    if(_confirm)
      return true;
    else
      return  false;
  });

  //=========================================================
  //grab input value our project
  let _input_denoate = $('.c_c'),
       button = $('.project-buttons button');

   // _input_denoate.val('');
   button.on('click',function()
   {
      $(this).siblings().removeClass('btn-active');
      $(this).addClass('btn-active');
     _input_denoate.val('')
     // _input_denoate.css('border','1px solid #ccc');
     console.log( $(this).parent().siblings('form-m-p').find('.c_c'))
    $(this).parent().siblings('form').find('.c_c').val($(this).children('.arrVal').val())
   });

//validation before add items to basket slider button
let _add_ = $('._add_');
  _add_.on('click',function(e){
    // e.preventDefault()
  let target = $(this).siblings().find('.c_c');
  $(this).siblings('.c_c').val()

  if(  $(this).siblings('.c_c').val()  ==='')
  {
    console.error('input can\'t be empty _add_');
     e.preventDefault();
  }
  else if($(this).siblings('.c_c').val() < 100)
  {
    console.error('input must be grater than or equal to 100 _add_');
     e.preventDefault();
  }  
  else if(isNaN( $(this).siblings('.c_c').val() ))
  {
    console.error('input must be valid number _add_');
     e.preventDefault();
  }  
  
});


  // $.ajaxSetup({
  //     headers: {
  //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //         }
  // });

//  using ajax for edit projectText

  // $.ajax({
  //   url:'get_project_data',
  //   // data:false,
  //   // async:false,
  //   data:{},
  //   // contentType:'',
  //   method:'get',
  //   success:function(response,statusCode,xhr){
  //     // console.log(response.projectData[1].projectId);
  //     // console.log(statusCode);
  //     // console.log(xhr);
  //     let pd =response.projectData;
  //     for (let i =0; i < pd.length;i++) {
  //       // console.log(pd[i].projectName);
  //       // $('#pimg .parent').html('<td>'+ $('#pimg').attr('src','uploads/'+pd[i].projectImage) + '</td>');
  //     }
  //   },
  //   error:function(e,r,t){
  //     console.log(e);
  //     console.log(r);
  //     console.log(t);
  //   },
  //   complete:function() {
  //     console.log('Done');
  //   }
  // })


});
