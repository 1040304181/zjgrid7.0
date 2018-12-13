var wrapper = document.getElementById("signature-pad"),
    clearButton = wrapper.querySelector("[data-action=clear]"),
    saveButton = wrapper.querySelector("[data-action=save]"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    var ratio =  Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();

signaturePad = new SignaturePad(canvas);

clearButton.addEventListener("click", function (event) {
    signaturePad.clear();
    
});



//保存按钮
saveButton.addEventListener("click", function (event) {
    if (signaturePad.isEmpty()) {
        alert("请签名！.");
    } else {
    	//
		   //window.open(signaturePad.toDataURL());
		   
		   //点击msave动作 	
$("#msave").click(function(){

		$('#msave').attr('disabled', true);
//查看签名  
	//alert(signaturePad.toDataURL());
	$.post('save.php',{data:signaturePad.toDataURL()},function(data) {
			//保存按钮显示
		     		$('#msave').attr('disabled', false);
	          //现实签名结果
           // $("#result").html(data)
           //返回上一页
          history.go(-1);
        })	
		})

    }
 });

