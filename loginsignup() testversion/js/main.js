/*==================== MENU SHOW Y HIDDEN ====================*/
const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')

/*===== MENU SHOW =====*/
/* Validate if constant exists */
if(navToggle){
    navToggle.addEventListener('click', () => {
        navMenu.classList.add('show-menu')
    })
}

/*===== MENU HIDDEN =====*/
/* Validate if constant exists */
if(navClose){
    navClose.addEventListener('click', () => {
        navMenu.classList.remove('show-menu')
    })
}

/*==================== REMOVE MENU MOBILE ====================*/
const navLink = document.querySelectorAll('.nav__link')

function linkAction(){
    const navMenu = document.getElementById('nav-menu')
    // When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))

/*==================== ACCORDION SKILLS ====================*/
const skillsContent = document.getElementsByClassName('skills__content'),
      skillsHeader = document.querySelectorAll('.skills__header')

function toggleSkills(){
    let itemClass = this.parentNode.className

    for(i = 0 ; i < skillsContent.length; i++){
        skillsContent[i].className = 'skills__content skills__close'
    }
    if(itemClass === 'skills__content skills__close'){
        this.parentNode.className = 'skills__content skills__open'
    }
}

skillsHeader.forEach((el) =>{
    el.addEventListener('click', toggleSkills)
})

/*==================== QUALIFICATION TABS ====================*/
const tabs = document.querySelectorAll('[data-target]'),
      tabContents = document.querySelectorAll('[data-content]')

tabs.forEach(tab =>{
    tab.addEventListener('click', () =>{
        const target = document.querySelector(tab.dataset.target)

        tabContents.forEach(tabContent =>{
            tabContent.classList.remove('qualification__active')
        })
        target.classList.add('qualification__active')

        tabs.forEach(tab =>{
            tab.classList.remove('qualification__active')
        })
        tab.classList.add('qualification__active')
    })
})
/*==================== SERVICES MODAL ====================*/
const modalViews = document.querySelectorAll('.services__modal'),
      modalBtns = document.querySelectorAll('.services__button'),
      modalCloses = document.querySelectorAll('.services__modal-close')

let modal = function(modalClick){
    modalViews[modalClick].classList.add('active-modal')
}

modalBtns.forEach((modalBtn, i) => {
    modalBtn.addEventListener('click', () =>{
        modal(i)
    })
})

modalCloses.forEach((modalClose) =>{
    modalClose.addEventListener('click', () =>{
        modalViews.forEach((modalView) => {
            modalView.classList.remove('active-modal')
        })
    })
})

/*==================== PORTFOLIO SWIPER  ====================*/
let swiperPortfolio = new Swiper(".portfolio__container", {
    cssMode: true,
    loop: true,

    navigation:{
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });


/*==================== TESTIMONIAL ====================*/

let swiperTestimonial = new Swiper(".testimonial__container", {
    loop: true,
    grabCursor: true,
    spaceBetween: 48,

    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    breakpoints:{
         568:{
             slidesPerView: 2,
         }
    }
  });

/*==================== SCROLL SECTIONS ACTIVE LINK ====================*/
const sections = document.querySelectorAll('section[id]')

function scrollActive(){
    const scrollY = window.pageYOffset

    sections.forEach(current =>{
        const sectionHeight = current.offsetHeight
        const sectionTop = current.offsetTop - 50;
        sectionId = current.getAttribute('id')

        if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.add('active-link')
        }else{
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.remove('active-link')
        }
    })
}
window.addEventListener('scroll', scrollActive)

/*==================== CHANGE BACKGROUND HEADER ====================*/ 
function scrollHeader(){
    const nav = document.getElementById('header')
    // When the scroll is greater than 200 viewport height, add the scroll-header class to the header tag
    if(this.scrollY >= 80) nav.classList.add('scroll-header'); else nav.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)

/*==================== SHOW SCROLL UP ====================*/ 
function scrollUp(){
    const scrollUp= document.getElementById('scroll-up');
    // When the scroll is higher than 560 viewport height, add the show-scroll class to the a tag with the scroll-top class
    if(this.scrollY >= 560) scrollUp.classList.add('show-scroll'); else scrollUp.classList.remove('show-scroll')
}
window.addEventListener('scroll', scrollUp)

/*==================== DARK LIGHT THEME ====================*/ 
const themeButton = document.getElementById('theme-button')
const darkTheme = 'dark-theme'
const iconTheme = 'uil-sun'

// Previously selected topic (if user selected)
const selectedTheme = localStorage.getItem('selected-theme')
const selectedIcon = localStorage.getItem('selected-icon')

// We obtain the current theme that the interface has by validating the dark-theme class
const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light'
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'uil-moon' : 'uil-sun'

// We validate if the user previously chose a topic
if (selectedTheme) {
  // If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
  document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)
  themeButton.classList[selectedIcon === 'uil-moon' ? 'add' : 'remove'](iconTheme)
}

// Activate / deactivate the theme manually with the button
themeButton.addEventListener('click', () => {
    // Add or remove the dark / icon theme
    document.body.classList.toggle(darkTheme)
    themeButton.classList.toggle(iconTheme)
    // We save the theme and the current icon that the user chose
    localStorage.setItem('selected-theme', getCurrentTheme())
    localStorage.setItem('selected-icon', getCurrentIcon())
})

/*==================================Create Event Section==========================================*/
var selectedFile;
/*hide submit button*/
$(document).ready(function(){
    $("#createeventbutton").hide();
})

/*upload image to firebase*/
$("#eventfile").on("change", function(event){
    selectedFile = event.target.files[0];
    $("#createeventbutton").show();
});

/*Submit function*/
function EventuploadFile(){
    alert('Event created succesfully')
    // Create a root reference
    var user = firebase.auth().currentUser;
    var uid;
            if (user != null) {
                uid = user.uid;
            }
    var filename = selectedFile.name;
    var storageRef = firebase.storage().ref('/Event/' + filename);
    var uploadTask = storageRef.put(selectedFile);  
    // Register three observers:
    // 1. 'state_changed' observer, called any time the state changes
    // 2. Error observer, called on failure
    // 3. Completion observer, called on successful completion
    uploadTask.on('state_changed', function(snapshot){
        // Observe state change events such as progress, pause, and resume
        // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
        console.log('Upload is ' + progress + '% done');
        switch (snapshot.state) {
        case firebase.storage.TaskState.PAUSED: // or 'paused'
            console.log('Upload is paused');
            break;
        case firebase.storage.TaskState.RUNNING: // or 'running'
            console.log('Upload is running');
            break;
        }
    }, function(error) {
        // Handle unsuccessful uploads
    }, function() {
        // Handle successful uploads on complete
        // For instance, get the download URL: https://firebasestorage.googleapis.com/...
        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
            var postKey = firebase.database().ref('/Event/').push().key;
            var updates = {};
            var postData= {
                url : downloadURL,
                FoodCat: $("#FoodCategory").val(),
                EventN: $("#EventName").val(),
                EventD: $("#EventDate").val(),
                EventT: $("#Eventtime").val(),
                EventM: $("#Eventmember").val(),
                Des: $("#Description").val(),
                address: $("#address").val(),
                user : user.uid,
            };
            updates['/Event/'+postKey] = postData;
            firebase.database().ref().update(updates);
            console.log('File available at', downloadURL);
        });
    });
}

/*=====================================Display Event Image & Event Info=============================================== */
var user = firebase.auth().currentUser;
var uid;
            if (user != null) {
                uid = user.uid;
            }
$(document).ready(function(){
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          // User is signed in.
          var token = firebase.auth().currentUser.uid;
          queryDatabase(token);
        } else {
          // No user is signed in.
        }
      });
});


function queryDatabase(token){
        var userId = firebase.auth().currentUser.uid;
            return firebase.database().ref('/Event/').once('value').then(function(snapshot) {
                var PostObject = snapshot.val();
                var username= (snapshot.val() && snapshot.val().username) || 'Anonymous';
                var keys = Object.keys(PostObject);
                var currentRow;
                for (var i = 0; i < keys.length; i++){
                    var currentObject = PostObject[keys[i]];
                    if (i % 4 == 0){
                        currentRow= document.createElement("div");
                        $(currentRow).addClass("row p-5");
                        $("#contentholder").append(currentRow);
                    }
                    var col = document.createElement("div");
                    $(col).addClass("col-lg-3");
                    var image = document.createElement("img");
                    $(image).addClass("contentImage");
                    image.src = currentObject.url;
                    var p1 = document.createElement("p");
                    $(p1).html(currentObject.EventN);
                    $(p1).addClass("EventTitle");
                    var p3 = document.createElement("p");
                    $(p3).html(currentObject.EventD);
                    $(p3).addClass("EDate");
                    var p4 = document.createElement("p");
                    $(p4).html(currentObject.EventT);
                    $(p4).addClass("ETime");
                    var p5 = document.createElement("p");
                    $(p5).html(currentObject.EventM);
                    $(p5).append('<i class="fas fa-user"></i>')
                    $(p5).addClass("EMember");
                    /*Join Button Auto Create*/
                    var joinbtn= document.createElement("button");
                    $(joinbtn).addClass("joinbtn")
                    joinbtn.innerHTML = "CLICK ME"; 
                    joinbtn.setAttribute('content', 'JOIN');
                    joinbtn.textContent = 'Join';
                    $(joinbtn).on("click", function(event){
                        alert('test Join');
                    });
                    /*Search Button Auto Create*/
                    var morebtn= document.createElement("button");
                    $(morebtn).addClass("morebtn")
                    morebtn.innerHTML = "CLICK ME"; 
                    morebtn.setAttribute('style', 'background-color: black,font-color: white');
                    morebtn.setAttribute('content', 'Learn More');
                    morebtn.textContent = 'Learn More....';
                    $(morebtn).on("click", function(event){
                        personalevent();
                    });
                    /*Update Button Auto Create
                    var updatebtn= document.createElement("button");
                    $(updatebtn).addClass("updatebtn")
                    updatebtn.innerHTML = "CLICK ME"; 
                    updatebtn.setAttribute('style', 'background-color: black,font-color: white');
                    updatebtn.setAttribute('content', 'Update');
                    updatebtn.textContent = 'Update';
                    $(updatebtn).on("click", function(event){
                        //join button will add
                        alert('test Update');
                    });
                    /*Delete Button Auto Create
                    var deletebtn= document.createElement("button");
                    $(deletebtn).addClass("deletebtn")
                    deletebtn.innerHTML = "CLICK ME"; 
                    deletebtn.setAttribute('style', 'background-color: black,font-color: white');
                    deletebtn.setAttribute('content', 'DELETE');
                    deletebtn.textContent = 'Delete';
                    $(deletebtn).on("click", function(event){
                        //join button will add
                        alert('test delete');
                    });*/

                    $(col).append(image);
                    $(col).append(p1,p3,p4,p5,joinbtn,morebtn);
                    $(currentRow).append(col);
                }
      });
}
function personalevent(){
    window.location.href = "./personal event.html";
}

// Create Option //
$(function(){
    var $select = $(".eventmember");
    for (i=1;i<=100;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
});
