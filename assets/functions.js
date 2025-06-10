let catsClicked = false;
let kadeIdxCurrent = 1;
let kadeLast = null;
let kadeList = ["kade11.png", "kade19.png", "kade23.png", "kade29.png", "kade33.png", "kade47.png", "kade66.png", "kade71.png", "kade76.png", "kade82.png", "kade87.png", "kade93.png", "kade12.png", "kade1.png", "kade24.png", "kade2.png", "kade35.png", "kade42.png", "kade55.png", "kade60.png", "kade67.png", "kade9.png", "kade13.png", "kade20.png", "kade25.png", "kade30.png", "kade38.png", "kade43.png", "kade4.png", "kade56.png", "kade61.png", "kade68.png", "kade73.png", "kade79.png", "kade84.png", "kade89.png", "kade.png", "kade14.png", "kade21.png", "kade27.png", "kade31.png", "kade39.png", "kade44.png", "kade50.png", "kade58.png", "kade6.png", "kade7.png", "kade8.png", "kade15.png", "kade28.png", "kade32.png", "kade3.png", "kade46.png", "kade52.png", "kade59.png", "kade65.png", "kade81.png"];

// {{{ function shuffle(array)
function shuffle(array) {
	let currentIndex = array.length, randomIndex;

	// While there remain elements to shuffle.
	while (currentIndex > 0) {

		// Pick a remaining element.
		randomIndex = Math.floor(Math.random() * currentIndex);
		currentIndex--;

		// And swap it with the current element.
		[array[currentIndex], array[randomIndex]] = [
			array[randomIndex], array[currentIndex]
		];
	};

	return array;
};
// }}}

// {{{ function catsClick()
function catsClick() {
	if (catsClicked) {
		document.body.style = '';
		catsClicked = false;
	} else {
		document.body.style = 'transform: rotate(180deg)';
		catsClicked = true;
	};
};
// }}}

// {{{ function kadeGetCurrent()
function kadeGetCurrent() {
	let kadeElement = document.getElementById("kade");
	let kadeCurrent = kadeElement.src;
	let kadeLastSepIdx = kadeCurrent.lastIndexOf("/");
	let kadePathBase = kadeCurrent.substring(0, ((kadeLastSepIdx === -1) ? kadeCurrent.length : kadeLastSepIdx));
	kadeCurrent = kadeCurrent.substring(((kadeLastSepIdx === -1) ? 0 : (kadeLastSepIdx + 1)));
	return [kadeCurrent, kadeElement, kadePathBase];
};
// }}}
// {{{ function kadeClick()
function kadeClick() {
	let [kadeCurrent, kadeElement, kadePathBase] = kadeGetCurrent();
	while (true) {
		shuffle(kadeList);
		let kadeNextIdx = (Math.random() * (kadeList.length ? (kadeList.length - 1) : 0)).toFixed();
		if ((kadeList[kadeIdxCurrent] !== kadeList[kadeNextIdx])
		&&  ((kadeLast === null)
		||   (kadeLast !== kadeList[kadeNextIdx])))
		{
			kadeLast = kadeList[kadeIdxCurrent];
			kadeIdxCurrent = kadeNextIdx;
			kadeElement.src = kadePathBase + "/" + kadeList[kadeNextIdx];
			break;
		};
	};
};
// }}}
// {{{ function kadeNext()
function kadeNext() {
	let [kadeCurrent, kadeElement, kadePathBase] = kadeGetCurrent();
	if (kadeIdxCurrent < kadeList.length) {
		kadeLast = kadeList[kadeIdxCurrent];
		kadeIdxCurrent++;
		kadeElement.src = kadePathBase + "/" + kadeList[kadeIdxCurrent];
	};
};
// }}}
// {{{ function kadePrevious()
function kadePrevious() {
	let [kadeCurrent, kadeElement, kadePathBase] = kadeGetCurrent();
	if (kadeIdxCurrent > 0) {
		kadeLast = kadeList[kadeIdxCurrent];
		kadeIdxCurrent--;
		kadeElement.src = kadePathBase + "/" + kadeList[kadeIdxCurrent];
	};
};
// }}}

// {{{ function roarieMouseOver()
function roarieMouseOver() {
	document.getElementById("roarie1").style.visibility = 'visible';
	document.getElementById("roarie2").style.visibility = 'visible';
	document.getElementById("roarie3").style.visibility = 'visible';
	document.getElementById("roarie4").style.visibility = 'visible';
	document.getElementById("roarie5").style.visibility = 'visible';
	document.getElementById("roarie6").style.visibility = 'visible';
	document.getElementById("roarie7").style.visibility = 'visible';
};
// }}}
// {{{ function roarieMouseOut()
function roarieMouseOut() {
	document.getElementById("roarie1").style.visibility = 'hidden';
	document.getElementById("roarie2").style.visibility = 'hidden';
	document.getElementById("roarie3").style.visibility = 'hidden';
	document.getElementById("roarie4").style.visibility = 'hidden';
	document.getElementById("roarie5").style.visibility = 'hidden';
	document.getElementById("roarie6").style.visibility = 'hidden';
	document.getElementById("roarie7").style.visibility = 'hidden';
};
// }}}

