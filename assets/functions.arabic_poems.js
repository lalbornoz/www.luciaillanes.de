let catsClicked = false;

function catsClick() {
	if (catsClicked) {
		document.body.style = '';
		catsClicked = false;
	} else {
		document.body.style = 'transform: rotate(180deg)';
		catsClicked = true;
	};
};

