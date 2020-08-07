function numberWithCommas(x){
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(".number").keyup(function(){
	var val = $(this).val().toString().replace(/,/g, "");
	for(var i=0; i<1; i++){
		var awal = val.toString().substr(0, 1);
		if(awal=="0"){
			i = 0;
			val = val.toString().substr(1, val.length);
		}
	}
	$(this).val(numberWithCommas(val));
})