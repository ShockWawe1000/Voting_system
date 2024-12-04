<?php 

function output_success($input)
{


echo "
<div class='container '>


 <div class='box form-box '>
  <header>Error</header>
         <div class='message_good'>
         <p>{$input}</p>
     </div> <br>
     <div class='button-container'>
      <a href='index.php'>
        <button class='btn'>Login Now</button>
    </a>
  </a>
 </div>
 </div>
 </div>

";
}


function output_error($input)
{

    echo "
       <div class='container '>
    
       
        <div class='box form-box '>
         <header>Error</header>
                <div class='message_bad'>
                <p>{$input}</p>
            </div> <br>
            <div class='button-container'>
             <a href='javascript:self.history.back()'>
             <button class='btn'>Go Back</button>
         </a>
        </div>
        </div>
        </div>

";
}


  //Pop ups, really inneficient, work wonders for debugs
?>