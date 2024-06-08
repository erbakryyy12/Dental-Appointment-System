<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Make appointment - user

    dd($request->all());
-->

@extends('layouts.baseUser')

@section('User.appointment')

<style>
    .header-title {
        color: black; /* Set the color of the header title to black */
    }
    .appointmentTime.disabled 
    {
        background-color: red !important;
        cursor: not-allowed;
        pointer-events: none;
    }
    .appointmentTime.selected 
    {
        background-color: blue !important;
    }
</style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="header">
                    <h1 class="header-title">
                        Make Appointment
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Dentist Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if($selectedDentist->dentistImage)
                                    <img src="{{ Storage::url($selectedDentist->dentistImage) }}" class="card-img-top" alt="Dentist Image">
                                @else
                                    <img src="/path/to/default/image.jpg" class="card-img-top" alt="Default Image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">DR.{{ $selectedDentist->user->userName }}</h5>
                                    <p class="card-text">{{ $selectedDentist->dentistSpeciality }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Calendar and Time Slot -->
                        <div class="col-md-6 mb-4">
                            <h5>Select Appointment Date</h5>
                            <div id="calendar"></div>
                            <br>
                            <h5>Select Time Slot</h5>
                            <div id="appointmentTime"> 
                                @foreach($availableTimeSlots as $timeSlot)
                                    <button class="appointmentTime available" data-time="{{ $timeSlot }}">{{ $timeSlot }}</button>
                                @endforeach
                            </div>

                            <form method="POST" action="{{ route('appointment.store') }}">
                                @csrf
                                <input type="hidden" id="userID" name="userID" value="{{ Auth::id() }}">
                                <input type="hidden" id="dentistID" name="dentistID" value="{{ $dentistID }}">
                                <input type="hidden" id="selectedDate" name="selectedDate">
                                <input type="hidden" id="selectedTime" name="selectedTime">
                                <br>
                                <button type="submit" name="confirmAppointment" value="1" class="btn btn-primary" style="background-color: #B2EEF1;border-color: #B2EEF1;color: #000;">Confirm Appointment</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
            // Initialize a variable to store the selected date
            var selectedDate = '';

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, 
            {

                // Your FullCalendar configuration
                selectable: true, // Enable date selection

                validRange: {
                    start: new Date() // Disable past dates
                },


                select: function(info) 
                {
                    selectedDate = info.startStr; // Update the selected date

                    // Set the selected date to the hidden input field
                    document.getElementById('selectedDate').value = selectedDate;   

                    // Display confirmation message with selected date
                    var selectedDate = info.startStr;
                    alert('You have selected ' + selectedDate);

                    // Fetch booked time slots for the selected date
                    fetchBookedTimeSlots({{ $dentistID }}, selectedDate);
                    
                    // Highlight the selected date
                    calendar.removeAllEventSources(); // Remove existing events
                    calendar.addEventSource([
                        {
                            title: 'Selected',
                            start: selectedDate,
                            color: 'blue'
                        }
                    ]);
                   
                }
                
            });

            calendar.render();

            //function to disable the time slot if already chosen
            function fetchBookedTimeSlots(dentistID, appointmentDate) 
            {
                fetch('{{ route('appointments.bookedTimeSlots') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ dentistID: dentistID, appointmentDate: appointmentDate })
                })
                .then(response => response.json())
                .then(bookedTimeSlots => {
                    updateAvailableTimeSlots(bookedTimeSlots);
                });
            }

            function updateAvailableTimeSlots(bookedTimeSlots) {
                var appointmentTimeButtons = document.querySelectorAll('.appointmentTime');
                appointmentTimeButtons.forEach(function(button) {
                    var timeSlot = button.getAttribute('data-time');
                    if (bookedTimeSlots.includes(timeSlot)) {
                        button.classList.add('disabled');
                        button.classList.remove('available');
                        button.disabled = true; // Disable the button
                    } else {
                        button.classList.remove('disabled');
                        button.classList.add('available');
                        button.disabled = false; // Enable the button
                    }
                });
            }

            // Attach click event listeners to time slots
            var appointmentTimeButtons = document.querySelectorAll('.appointmentTime');
            appointmentTimeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Check if the button is disabled (i.e., already booked)
                    if (!this.classList.contains('disabled')) {
                        appointmentTimeButtons.forEach(function(slot) {
                            slot.classList.remove('selected');
                        });
                        this.classList.add('selected');
                        var selectedTime = this.getAttribute('data-time');
                        document.getElementById('selectedTime').value = selectedTime;
                    }
                });
            });


            var appointmentTimeButtons = document.querySelectorAll('.appointmentTime');

            appointmentTimeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    if (!this.classList.contains('disabled')) {
                        appointmentTimeButtons.forEach(function(slot) {
                            slot.classList.remove('selected');
                        });
                        this.classList.add('selected');

                        var selectedTime = this.getAttribute('data-time');
                        document.getElementById('selectedTime').value = selectedTime;
                    }
                });
            });

            // Form submission handler
            var appointmentForm = document.querySelector('form');
            appointmentForm.addEventListener('submit', function(event) {
                var selectedTime = document.getElementById('selectedTime').value;
                var selectedTimeButton = document.querySelector('.appointmentTime[data-time="' + selectedTime + '"]');
                
                // Check if the selected time slot is disabled (i.e., already booked)
                if (selectedTimeButton && selectedTimeButton.classList.contains('disabled')) {
                    event.preventDefault(); // Prevent form submission
                    alert('This time slot is already booked. Please choose another time.');
                }
            });

            
        });


    </script>
    @endsection


@endsection

         
