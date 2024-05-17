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
                                <img src="/img/dentist female.jpeg" class="card-img-top " alt="Dentist Image">
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
                                <button type="submit" name="confirmAppointment" value="1" class="btn btn-primary">Confirm Appointment</button>
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
                select: function(info) 
                {
                    selectedDate = info.startStr; // Update the selected date

                    // Display confirmation message with selected date
                    var selectedDate = info.startStr;
                    alert('You have selected ' + selectedDate);
                    
                    // Highlight the selected date
                    calendar.removeAllEventSources(); // Remove existing events
                    calendar.addEventSource([
                        {
                            title: 'Selected',
                            start: selectedDate,
                            color: 'blue'
                        }
                    ]);

                    // Set the selected date to the hidden input field
                    document.getElementById('selectedDate').value = selectedDate;   

                },
                unselect: function(info) 
                {
                    selectedDate = ''; // Clear the selected date
                
                }
            });

            calendar.render();

            // Function to update the availability status of the dates
            function updateDateAvailability() {
                // Your existing code for updating date availability
            }

            // Attach click event listeners to time slots
            var appointmentTimeButtons = document.querySelectorAll('.appointmentTime');
            appointmentTimeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    appointmentTimeButtons.forEach(function(slot) {
                        slot.style.backgroundColor = '';
                    });
                    this.classList.toggle('available');
                    updateDateAvailability();
                    if (this.classList.contains('available')) {
                        this.style.backgroundColor = 'blue';
                    }

                    // Get the data-time attribute of the clicked time slot
                    var selectedTime = this.getAttribute('data-time');

                    // Set the selected time to the hidden input field
                    document.getElementById('selectedTime').value = selectedTime;
                });
            });


            
        });


    </script>
    @endsection


@endsection

         
