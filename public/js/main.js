// Get the element you want to add the class to
const element = document.querySelector('.navbar');

// Add a scroll event listener to the window
window.addEventListener('scroll', function () {
    // Get the current scroll position
    const scrollPosition = window.scrollY;

    // Check if the scroll position is greater than or equal to 10 pixels
    if (scrollPosition >= 10) {
        // Add the class to the element
        element.classList.add('navbar_active');
    } else {
        // Remove the class from the element if scroll position is less than 10 pixels
        element.classList.remove('navbar_active');
    }
});

// nav bar

const menu = document.querySelector(".ham_menu");
const menu1 = document.getElementById("ham_menu2");

$(".ham_menu").on('click', function () {
    $('.ham_menu').toggleClass('is-active');
    $('.m-navbar-div').toggleClass('blockimp');
});





const child = document.querySelector(".child-cate");

$(".profile").on('click', function () {
    child.classList.toggle('fleximp');
});

// rotate +

function rotate(no) {
    $(".work-content").addClass('d-none');
    $(".rotateimg").removeClass('rotate45');
    $(".rotate" + no).addClass("rotate45");
    $(".work-content" + no).removeClass("d-none");
}


// popupopen
function popupopen(id) {
    $("#" + id).css("display", "flex")
}

function popupclose(id) {
    $("#" + id).css("display", "none")
}

// // preview
function clicker(input) {
    $("#" + input).click();
}

function previewImage(event, preview) {
    console.log(event);
    var file = event.target.files[0];
    var reader = new FileReader();
    var preview = document.getElementById(preview);

    reader.onload = function (e) {
        preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
}



// calender

var currentDate = new Date();
var currentMonth = currentDate.getMonth();
var currentYear = currentDate.getFullYear();
var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

var calendarBody = document.getElementById('calendar-body');
var monthYearText = document.getElementById('month-year');
var prevBtn = document.getElementById('prev-btn');
var nextBtn = document.getElementById('next-btn');

// Display calendar for the current month and year

if (typeof decodedArray !== 'undefined') {
    displayCalendar(currentMonth, currentYear, decodedArray);
}
if (prevBtn !== null && nextBtn !== null) {
    // Event listeners for previous and next buttons
    prevBtn.addEventListener('click', function () {
        currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        loadMonthData(currentMonth, currentYear);
        displayCalendar(currentMonth, currentYear);
    });

    nextBtn.addEventListener('click', function () {
        currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth + 1) % 12;
        loadMonthData(currentMonth, currentYear);
        displayCalendar(currentMonth, currentYear, decodedArray);
    });

}

function displayCalendar(month, year, decodedArray) {

    var firstDay = new Date(year, month, 1).getDay();
    var daysInMonth = new Date(year, month + 1, 0).getDate();

    calendarBody.innerHTML = '';
    monthYearText.textContent = months[month] + ' ' + year;

    var date = 1;
    var presentCount = 0;
    var absentCount = 0;
    var holidayCount = 0;
    for (var i = 0; i < 6; i++) {
        var row = document.createElement('tr');
        for (var j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                var cell = document.createElement('td');
                var cellText = document.createTextNode('');
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth) {
                break;
            } else {
                var cell = document.createElement('td');
                cell.setAttribute('id', 'date-' + date + '-' + (month + 1) + '-' + year); // Set the ID
                var cellText = document.createTextNode(date);
                cell.appendChild(cellText);
                if (decodedArray != undefined) {
                    var eventData = getEventData(date, month + 1, year, decodedArray); // Get event data for the current date
                    if (eventData) {

                        if (eventData.techer_attend === 'yes' && eventData.student_attend === 'yes') {
                            cell.classList.add('teacher-attand'); // Apply red color to the cell
                            presentCount = presentCount + 1;
                        }

                        if ((eventData.techer_attend === 'no' || eventData.student_attend === 'no') && !(eventData.isHolyday === 'yes' || eventData.isSecondSaturday === 'yes' || eventData.isSunday === "yes" || eventData.isFourtSaturday === "yes")) {
                            cell.classList.add('teacher-absent'); // Apply red color to the cell
                            absentCount = absentCount + 1;
                        }
                        if (eventData.isHolyday === 'yes' || eventData.isSecondSaturday === 'yes' || eventData.isSunday === "yes" || eventData.isFourtSaturday === "yes") {
                            cell.classList.add('holiday'); // Apply gray color to the cell
                            holidayCount = holidayCount + 1;
                        }
                    }
                }
                row.appendChild(cell);
                date++;
            }
        }
        calendarBody.appendChild(row);
    }
    $("#classtaken").html(presentCount);
    $("#absent").html(absentCount);
    $("#holiday").html(holidayCount);
}

function getEventData(date, month, year, decodedArray) {
    var eventData = decodedArray;

    eventData.forEach(function (event) {
        var eventDate = new Date(event.dt);
        if (eventDate.getDate() === date && eventDate.getMonth() + 1 === month && eventDate.getFullYear() === year) {
            eventData = event;
        }
    });
    return eventData;
}

function loadMonthData(currentMonth, currentYear) {
    $.ajax({
        url: 'loadMonthdata',
        data: {
            month: currentMonth + 1,
            year: currentYear,
            id: document.getElementById("student_id").value
        },
        type: 'get',
        success: function (data) {
            var subject = document.getElementById("subjectName").value;
            var decodedArray = data[subject];
            console.log(decodedArray);
            displayCalendar(currentMonth, currentYear, decodedArray);
        }
    })
}


// auto scroll

function autoScroll(elementId, scrollDelay) {
    var container = document.getElementById(elementId);
    var containerWidth = container.offsetWidth;

    var scrollAmount = 0;
    var maxScroll = container.scrollWidth - containerWidth;

    function scroll() {
        container.scrollLeft = scrollAmount;
        scrollAmount++;

        if (scrollAmount > maxScroll) {
            scrollAmount = 0;
        }
    }

    setInterval(scroll, scrollDelay);
}






// sliders 
new Splide('.splide', {
    type: 'loop',
    autoplay: true,
    arrows: false
}).mount();
document.addEventListener('DOMContentLoaded', function () {
    var splide = new Splide('.splide2', {
        perPage: 4,
        pagination: false,
        type: 'loop',
        autoplay: true,
        arrows: false,
        breakpoints: {
            1075: {
                perPage: 3,
            },
            850: {
                perPage: 2,
            },
            850: {
                perPage: 2,
            },
            550: {
                perPage: 1,
            }
        }
    }).mount();

    var prevArrow = document.querySelector('.arrow img[src="images/prevarrow.svg"]');
    var nextArrow = document.querySelector('.arrow img[src="images/nextarrow.svg"]');
    var progressBar = document.querySelector('.my-slider-progress-bar');

    prevArrow.addEventListener('click', function () {
        splide.go('-');
    });

    nextArrow.addEventListener('click', function () {
        splide.go('+');
    });

    splide.on('move', function () {
        var progress = (splide.index / (splide.length - splide.options.perPage)) * 100;
        progressBar.style.width = progress + '%';
    });
});


document.addEventListener('DOMContentLoaded', function () {
    var testimonialsSlider = new Splide('.splide3', {
        type: 'loop',
        autoplay: true,
        arrows: true,
        pagination: false,
        perPage: 3,
        gap: 30,
        breakpoints: {
            950: {
                perPage: 2,
            },
            750: {
                perPage: 1,
            }
        }
    }).mount();

    var prevArrow = document.querySelector('.prev-arrow1');
    var nextArrow = document.querySelector('.next-arrow1');

    prevArrow.addEventListener('click', function () {

        testimonialsSlider.go('prev');
        $(".splide__arrow--prev").click()
    });

    nextArrow.addEventListener('click', function () {
        testimonialsSlider.go('next');
        $(".splide__arrow--next").click()
    });
});



// Call the autoScroll function with the container ID and scroll delay
autoScroll("scrollableContainer", 20);
autoScroll("scrollableContainer2", 20);
