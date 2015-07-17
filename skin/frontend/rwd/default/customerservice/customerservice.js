

var car = {};

window.onload = cscare;

/* Fancy-box launch */
jQuery(document).ready(function() {
	jQuery('.fancybox').fancybox();
		jQuery(".fancybox.ajax").click(function() {
			jQuery.fancybox.open({
				href: '',
				type : 'ajax',	
			});
		});
	});
	

/* String presence finder */

String.prototype.containsWord = function(word) {
    var regex = new RegExp('\\b' + word + '\\b');
    return regex.test(this);
};



/* Function that activates on load and also called for changing the FAQs */

function cscare() {


    var faqid = document.getElementsByClassName('selected');
    for (var j = 0; j < faqid.length; j++) {
        dataid = faqid[j].getAttribute("data-faq");
        var vanish = document.getElementById(dataid);
        if (vanish) {
            vanish.style.display = 'block';
        }
    }

    for (var i = 0; i < $$('.order-children').length; i++) {

        $$('.order-children')[i].observe('click', function() {
            selectedOrder(this);
        });
    }



    for (var m = 0; m < $$('.other-children').length; m++) {

        $$('.other-children')[m].observe('click', function() {
            selectedOther(this);
        });
    }

    var chosenOrderIssue = document.getElementById('chosen-order-issue');


    $(chosenOrderIssue).observe('click', function() {
        step21(this);
    });

    var chosenOtherIssue = document.getElementById('chosen-other-issue');

    $(chosenOtherIssue).observe('click', function() {
        stepOther21(this);
    });

   
}


/* Function that changes the FAQ when the mouse pointer is hovered over each issue(parent) and subissue(children) in the first tab */

function checkorder() {
    var orderparent = document.getElementsByClassName('order-parent');
    var orderchildren = document.getElementsByClassName('order-children');
    for (var k = 0; k < orderparent.length; k++) {
        var currentparentclass = orderparent[k].className;
        if (currentparentclass.containsWord("selected")) {
            currentparentclass = currentparentclass.replace(' selected', '');
            orderparent[k].className = currentparentclass;
            dataid = orderparent[k].getAttribute("data-faq");
            var vanish = document.getElementById(dataid);

            vanish.style.display = 'none';
        }

    }
    for (var l = 0; l < orderchildren.length; l++) {
        var currentchildclass = orderchildren[l].className;
        if (currentchildclass.containsWord("selected")) {
            currentchildclass = currentchildclass.replace(' selected', '');
            orderchildren[l].className = currentchildclass;
            dataid = orderchildren[l].getAttribute("data-faq");
            var vanish = document.getElementById(dataid);
            vanish.style.display = 'none';
        }

    }
}


/* Function that changes the FAQ when the mouse pointer is hovered over each issue(parent) and subissue(children) in the second tab */

function checkother() {
    var otherparent = document.getElementsByClassName('other-parent');
    var otherchildren = document.getElementsByClassName('other-children');
    for (var k = 0; k < otherparent.length; k++) {
        var currentparentclass = otherparent[k].className;
        if (currentparentclass.containsWord("selected")) {
            currentparentclass = currentparentclass.replace(' selected', '');
            otherparent[k].className = currentparentclass;
            dataid = otherparent[k].getAttribute("data-faq");
            var vanish = document.getElementById(dataid);
            vanish.style.display = 'none';
        }

    }
    for (var l = 0; l < otherchildren.length; l++) {
        var currentchildclass = otherchildren[l].className;
        if (currentchildclass.containsWord("selected")) {
            currentchildclass = currentchildclass.replace(' selected', '');
            otherchildren[l].className = currentchildclass;
            dataid = otherchildren[l].getAttribute("data-faq");
            var vanish = document.getElementById(dataid);
            vanish.style.display = 'none';
        }

    }
}


/* Function that is fired when on the mouse-over event in the issue and and subissue in the first tab */

function lead(f) {
    checkorder();
    dataid = f.getAttribute("data-faq");

    f.className = f.className + " selected";
    cscare();

}


/* Function that is fired when on the mouse-over event in the issue and and subissue in the second tab */

function other(g) {
    checkother();
    dataid = g.getAttribute("data-faq");

    g.className = g.className + " selected";
    cscare();

}


/* Function for hiding the other parent issues when one parent issue has been clicked */

function clearparent(x) {
    if (x.className.containsWord("order-parent")) {

        var orderparent = document.getElementsByClassName('order-parent');

        for (var k = 0; k < orderparent.length; k++) {
            var currentparentclass = orderparent[k].className;
            if (!(currentparentclass.containsWord("selected"))) {


                orderparent[k].style.display = 'none';
            }

        }
    } else {
        var otherparent = document.getElementsByClassName('other-parent');

        for (var k = 0; k < otherparent.length; k++) {
            var currentparentclass = otherparent[k].className;
            if (!(currentparentclass.containsWord("selected"))) {


                otherparent[k].style.display = 'none';
            }

        }
    }

}


/*Function for displaying the other parent issues when the selected parent is clicked again */

function unclear(y) {
    if (y.className.containsWord("order-parent")) {
        var orderparent = document.getElementsByClassName('order-parent');

        for (var k = 0; k < orderparent.length; k++) {

            orderparent[k].style.display = 'block';

        }
    } else {
        var otherparent = document.getElementsByClassName('other-parent');

        for (var k = 0; k < otherparent.length; k++) {

            otherparent[k].style.display = 'block';
        }
    }

}

/* Function for the dropdown effect of the parent issue that works in both the tabs */

function drop(h) {

    var parentheight = document.getElementById('order-issue').offsetHeight;

    if (h.className.containsWord("clicked")) {

        h.className = h.className.replace(' clicked', '');

        var y = $(h).next();

        Effect.BlindUp(y.id, {
            duration: 0.5
        });
		
		//jQuery(y).slideUp(200);
		var icon = h.childElements();
		icon[1].style.transform = 'rotate(0deg)';
        unclear(h);
        $(h).setStyle({
            borderBottom: '2px solid #EEE'
        });


    } else {
        h.className = h.className + " clicked";
        clearparent(h);
        $(h).setStyle({
            borderBottom: '2px solid #EEE'
        });
		
        var y = $(h).next();
        // y.offsetHeight = parentheight;

        Effect.BlindDown(y.id, {
            duration: 0.5
        });
		
		//jQuery(y).slideDown(200);
		var icon = h.childElements();
		icon[1].style.transform = 'rotate(90deg)';
		icon[1].addClassName('cstrans');
    }



}


/* Function that runs when an issue is selected in the first tab */

function selectedOrder(h) {
    var selectedchild = h.innerHTML;
    var selectedparent = h.up().previous(0).childElements()[0].innerHTML;
    car.issue = selectedparent + ' > ' + selectedchild;
    document.getElementById("order-issue").style.display = 'none';
    document.getElementById("order-faq").style.display = 'none';
    document.getElementById('chosen-order-issue').style.display = 'inline-block';
    document.getElementById('chosen-order-parent').innerHTML = selectedparent;
    document.getElementById('chosen-order-child').innerHTML = selectedchild;
    $('chosen-order-parent').addClassName('chosen-parent');
    $('chosen-order-child').addClassName('chosen-child');
    $('chosen-order-issue').addClassName('chosen-issue');

    if ($('not-logged-in')) {
        $('not-logged-in').removeClassName('csdisable');
    }

    if ($('logged-in')) {
        $('logged-in').removeClassName('csdisable');
    }



}



/*Function that runs when an issue is unselected in the first tab */

function step21(b) {
    b.style.display = 'none';

    document.getElementById("order-issue").style.display = 'inline-block';
    document.getElementById("order-faq").style.display = 'inline-block';

    if ($('not-logged-in')) {
        $('not-logged-in').addClassName('csdisable');
    }

    if ($('logged-in')) {
        $('logged-in').addClassName('csdisable');
    }

}


/* Function that runs when an issue is selected in the second tab */
function selectedOther(h) {

    var selectedchild = h.innerHTML;
    var selectedparent = h.up().previous(0).childElements()[0].innerHTML;
    car.otherissue = selectedparent + ' > ' + selectedchild;
    document.getElementById("other-issue").style.display = 'none';
    document.getElementById("other-faq").style.display = 'none';
    document.getElementById('chosen-other-issue').style.display = 'inline-block';
    document.getElementById('chosen-other-parent').innerHTML = selectedparent;
    document.getElementById('chosen-other-child').innerHTML = selectedchild;
    $('chosen-other-parent').addClassName('chosen-parent');
    $('chosen-other-child').addClassName('chosen-child');
    $('chosen-other-issue').addClassName('chosen-issue');
    $('other-email').removeClassName('csdisable');

}


/* Function that runs when an issue is unselected in the second tab */

function stepOther21(b) {
	
    b.style.display = 'none';
    document.getElementById("other-issue").style.display = 'inline-block';
    document.getElementById("other-faq").style.display = 'inline-block';
    $('other-email').addClassName('csdisable');


}

/************************Logged -in AJAX load *************************/

function launch(url) {
    new Ajax.Request(url, {
            method: 'get',
            onCreate: startLoading,
            onComplete: stopLoading,
            onSuccess: successFunc,
            onFailure: failureFunc        
        });

    function successFunc(response) {

        if (200 == response.status) {
           
        }
        var container = $('logged-in');
        var content = response.responseText;
        container.update(content);
    }

    function failureFunc(response) {

        alert("Please refresh the page and try again");

    }

}


/******************************* Not-logged-in AJAX load *********************/

function launchSearch(url) {
    new Ajax.Request(url, {
            method: 'get',
            onCreate: startLoading,
            onComplete: stopLoading,
            onSuccess: successFunc,
            onFailure: failureFunc          
        });

    function successFunc(response) {

        if (200 == response.status) {
            //alert("Call is success");
        }
        var container = $('not-logged-in');
        var content = response.responseText;
        container.update(content);
    }

    function failureFunc(response) {

        alert("Please refresh the page and try again");

    }

}
