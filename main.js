// TweenMax.to(".logo", 6, {
//     left:600, 
//     backgroundColor:"#f00",
//     padding:5,
//     borderColor:"white",
//     borderStyle:"solid",
//     borderWidth:5,
//     borderRadius:26
// });

// TweenMax.to(".logo", 6, {x:600, rotation:360, scale:0.5});

// TweenMax.to(".logo", 2, {x:600, ease:Back.easeOut});

// TweenMax.to(".logo", 2, {x:600, ease:Elastic.easeOut});

// TweenMax.from(".logo", 0.5, {opacity:0, scale:0, ease:Bounce.easeOut});


TweenMax.staggerFrom(".logo", 0.5, {opacity:0, y:200, delay:0.5}, 0.2);

