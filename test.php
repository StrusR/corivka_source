<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script>

$.fn.swap = function (b) {

  $(this).each(function(i){

    var b1 = $(b)[i],

      a2 = $(this).clone(),

      b2 = $(b1).clone();

    $(this).replaceWith(b2);

    $(b1).replaceWith(a2);

  });

};

$(function() {

  $('button').click(function(){

    $(".odd, .odds").swap($(".even, .evens"));

  });

});

</script>

<div class="odd">odd1</div><br />

<div class="even">even1</div><br />

<div class="odd">odd2</div><br />

<div class="even">even2</div><br />

<div class="odd">odd3</div><br />

<div class="even">even3</div><br />

<button>swap</button><br />

<div class="odds">odds1</div><br />

<div class="evens">evens1</div><br />

<div class="odds">odds2</div><br />

<div class="evens">evens2</div><br />

<div class="odds">odds3</div><br />

<div class="evens">evens3</div>
</body>
</html>