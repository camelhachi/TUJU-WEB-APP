// Function for faq, faq1, faq2
function addAccordionListeners(className) {
  var acc = document.getElementsByClassName(className);

  for (var i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
      this.classList.toggle("active");

      var panel = this.nextElementSibling;
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        panel.style.display = "block";
      }
    });
  }
}

addAccordionListeners("faq");
addAccordionListeners("faq1");
addAccordionListeners("faq2");



function redirectToOptions() {
  console.log('Function called');
  var selectedRoomType = document.querySelector('input[name="roomType"]:checked').value;
  document.getElementById('selectedRoomType').value = selectedRoomType;
}


function changeRoom() {
  const hotelRoomsRadio = document.getElementById("hotelRooms");
  const roomTypeInput = document.getElementById("roomType");

  if (hotelRoomsRadio.checked) {
    document.getElementById("highlight").style.left = "0%";
    roomTypeInput.value = "hotelRooms";
  } else {
    document.getElementById("highlight").style.left = "75%";
    roomTypeInput.value = "multipurposeRooms";
  }

  // Submit the form after changing the room type
  submitForm();
}

function submitForm() {
  // This is the only modification - directly setting the selectedRoomType value
  var selectedRoomType = document.querySelector('input[name="roomType"]:checked').value;
  document.getElementById('selectedRoomType').value = selectedRoomType;

  var selectedOutlet = document.getElementById('outlet').value;
  document.getElementById('selectedOutletInput').value = selectedOutlet;
  console.log("Selected Outlet: " + selectedOutlet);
  document.getElementById('roomSelectionForm').submit();
}




