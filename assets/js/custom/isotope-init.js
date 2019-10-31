/**
* ISOTOPE MASONRY & FILTERING
* Trigger Isotope layouts with isotope-pkgd.js
*/

// Find .grid in DOM
var isotopeGridBlock = document.getElementsByClassName('grid');

// Run Isotope if .grid is present 
if (isotopeGridBlock.length > 0) {
  var iso = new Isotope( '.grid', {
    itemSelector: '.element-item',
    layoutMode: 'fitRows'
    // masonry: {
    //   columnWidth: 50
    // }
  });
}

// bind filter button click
var filtersElem = document.querySelector('.filter-buttons');
if(filtersElem){ // check to see if filtersElem is not null, then add event listenter
  filtersElem.addEventListener( 'click', function( event ) {
    "use strict";
    // only work with buttons
    if ( !matchesSelector( event.target, 'button' ) ) {
      return;
    }
    var filterValue = event.target.getAttribute('data-filter');
    // use matching filter function
    // filterValue = filterFns[ filterValue ] || filterValue;
    iso.arrange({ filter: filterValue });
  });
}

// change is-checked class on buttons
var buttonGroups = document.querySelectorAll('.button-group');
for ( var i=0, len = buttonGroups.length; i < len; i++ ) {
  var buttonGroup = buttonGroups[i];
  radioButtonGroup( buttonGroup );
}

function radioButtonGroup( buttonGroup ) {
  "use strict";
  buttonGroup.addEventListener( 'click', function( event ) {
    // only work with buttons
    if ( !matchesSelector( event.target, 'button' ) ) {
      return;
    }
    buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
    event.target.classList.add('is-checked');
  });
}



