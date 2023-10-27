let catsClicked = false;
let kadeLast = null;
let kadeList = ["kade9.png", "kade11.png", "kade13.png", "kade14.png", "kade19.png", "kade20.png", "kade23.png", "kade24.png", "kade25.png", "kade27.png", "kade29.png", "kade30.png", "kade32.png", "kade33.png", "kade35.png", "kade38.png", "kade42.png", "kade44.png", "kade52.png", "kade58.png", "kade59.png", "kade65.png", "kade73.png", "kade81.png", "kade86.png", "kade93.png"];

function catsClick() {
	if (catsClicked) {
		document.body.style = '';
		catsClicked = false;
	} else {
		document.body.style = '-moz-transform: rotate(180deg)';
		catsClicked = true;
	};
};

function kadeClick() {
	let kadeElement = document.getElementById("kade");
	let kadeCurrent = kadeElement.src;
	let kadeLastSepIdx = kadeCurrent.lastIndexOf("/");
	let kadePathBase = kadeCurrent.substring(0, ((kadeLastSepIdx === -1) ? kadeCurrent.length : kadeLastSepIdx));
	kadeCurrent = kadeCurrent.substring(((kadeLastSepIdx === -1) ? 0 : (kadeLastSepIdx + 1)));

	while (true) {
		let kadeNextIdx = (Math.random() * (kadeList.length ? (kadeList.length - 1) : 0)).toFixed();
		let kadeNext = kadeList[kadeNextIdx];
		if ((kadeNext !== kadeCurrent)
		&&  ((kadeLast === null) || (kadeLast !== kadeNext)))
		{
			kadeLast = kadeCurrent;
			kadeElement.src = kadePathBase + "/" + kadeNext;
			break;
		};
	};
};

function roarieMouseOver() {
	document.getElementById("roarie1").style.visibility = 'visible';
	document.getElementById("roarie2").style.visibility = 'visible';
	document.getElementById("roarie3").style.visibility = 'visible';
	document.getElementById("roarie4").style.visibility = 'visible';
	document.getElementById("roarie5").style.visibility = 'visible';
	document.getElementById("roarie6").style.visibility = 'visible';
	document.getElementById("roarie7").style.visibility = 'visible';
};

function roarieMouseOut() {
	document.getElementById("roarie1").style.visibility = 'hidden';
	document.getElementById("roarie2").style.visibility = 'hidden';
	document.getElementById("roarie3").style.visibility = 'hidden';
	document.getElementById("roarie4").style.visibility = 'hidden';
	document.getElementById("roarie5").style.visibility = 'hidden';
	document.getElementById("roarie6").style.visibility = 'hidden';
	document.getElementById("roarie7").style.visibility = 'hidden';
};
