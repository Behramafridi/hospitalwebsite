document.addEventListener('DOMContentLoaded', function () {
  // Step click logic (safe)
  const steps = document.querySelectorAll('.step');
  if (steps && steps.length) {
    steps.forEach(step => {
      step.addEventListener('click', function () {
        document.querySelectorAll('.step').forEach(s => {
          s.classList.remove('bg-info');
          s.classList.add('bg-secondary');
        });

        this.classList.remove('bg-secondary');
        this.classList.add('bg-info');
      });
    });
  }

  // Appointment type -> show/hide step3 or step4
  const appointment = document.getElementById('appointmentType');
  const step3 = document.getElementById('step3');
  const step4 = document.getElementById('step4');

  if (appointment) {
    appointment.addEventListener('change', function () {
      const value = this.value;

      if (step3 && step4) {
        if (
          value === 'Telephone Consultation' ||
          value === 'Order Counselling Therapy Coming Soon'
        ) {
          step3.classList.remove('d-none');
          step4.classList.add('d-none');
        } else if (
          value === 'Video Consultation' ||
          value === 'Occupational Health Coming Soon'
        ) {
          step4.classList.remove('d-none');
          step3.classList.add('d-none');
        }
      }
    });
  }

  // Date -> show time slots (if markup uses ids from book-appointment)
  const dateInput = document.getElementById('appointmentDate');
  const timeSlots = document.getElementById('timeSlots');
  if (dateInput && timeSlots) {
    dateInput.addEventListener('change', function () {
      if (this.value) timeSlots.classList.remove('d-none'); else timeSlots.classList.add('d-none');
    });

    // Active time slot toggle
    document.querySelectorAll('#timeSlots button').forEach(btn => {
      btn.addEventListener('click', function () {
        document.querySelectorAll('#timeSlots button').forEach(b => {
          b.classList.remove('btn-info', 'text-white');
          b.classList.add('btn-outline-info');
        });

        this.classList.remove('btn-outline-info');
        this.classList.add('btn-info', 'text-white');
      });
    });
  }
});
