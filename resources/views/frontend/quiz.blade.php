@extends('frontend.layouts.app')

@section('title', 'quiz Page')
@section('meta_description', 'Welcome to our website')
@section('meta_keywords', 'home, laravel, website')


@section('content')
  <!-- QUIZ SECTION -->
  <section class="quiz-section" aria-label="Interactive Assessment">
    <div class="quiz-container reveal">

      <div class="quiz-progress">
        <div class="quiz-progress-bar" id="quizProgressBar"></div>
      </div>

      <!-- STEP 1: Question Pages -->
      <div id="quizFormView">
        <div class="quiz-header">
          <span class="quiz-step" id="quizStepText">Step 1 of 3</span>

        </div>
        <div class="quiz-body" aria-live="polite">
          <p class="quiz-step-subtitle" id="quizStepSubtitle">Questions 1 – 8 &nbsp;·&nbsp; Comprehensive Assessment</p>
          <div class="quiz-rows" id="quizRows"></div>
        </div>
        <div class="quiz-nav">
          <button class="quiz-btn-back" id="quizBtnBack" onclick="quizGoBack()" style="display:none;">&#8592;
            Back</button>
          <span class="quiz-nav-info" id="quizNavInfo">Answer all questions to continue</span>
          <button class="quiz-btn-next" id="quizBtnNext" onclick="quizGoNext()" disabled>Continue &#8594;</button>
        </div>
      </div>

      <!-- STEP TEASER -->
      <div id="quizTeaserView" class="quiz-view-teaser" style="display:none;">
        <h2 class="quiz-teaser-title">Your Fertility Score: <span style="color:var(--gold);">Moderate
            &#9888;&#65039;</span></h2>
        <p class="quiz-teaser-desc">You may have some concerns that need attention...</p>
        <div class="teaser-blur-box">
          <div class="teaser-blur-content">
            <h4 style="margin-bottom:1rem;">Detailed Medical Analysis</h4>
            <p>Based on your age and lifestyle factors, we have identified specific metrics that could be influencing your
              clinical fertility journey right now.</p>
            <ul style="margin-top:1rem;padding-left:1.5rem;">
              <li>Hormonal alignment indicators</li>
              <li>Cycle regularity impact</li>
              <li>Lifestyle and historical factors</li>
              <li>Male partner fertility factors</li>
            </ul>
          </div>
          <div class="teaser-blur-overlay">
            <button class="btn-primary-dark" onclick="showLeadView()">Unlock Full Results <svg width="15" height="15"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7" />
              </svg></button>
          </div>
        </div>
      </div>

      <!-- STEP LEAD CAPTURE -->
      <div id="quizLeadView" class="quiz-view-lead" style="display:none;">
        <h2 class="quiz-lead-title">Where should we send your results?</h2>
        <p class="quiz-lead-desc">Enter your details to instantly unlock your customised fertility map.</p>
        <div class="quiz-form">
          <div class="form-group">
            <label for="leadName">Full Name</label>
            <input type="text" id="leadName" class="form-input" placeholder="Jane Doe" required>
          </div>
          <div class="form-group">
            <label for="leadPhone">Phone Number</label>
            <input type="tel" id="leadPhone" class="form-input" placeholder="+91 999 999 9999" required>
          </div>
          <div class="form-group">
            <label for="leadEmail">Email Address (Optional)</label>
            <input type="email" id="leadEmail" class="form-input" placeholder="jane@example.com">
          </div>
          <div class="form-group">
            <label for="leadCity">City (Optional)</label>
            <input type="text" id="leadCity" class="form-input" placeholder="Ahmedabad">
          </div>
          <button class="btn-primary-dark btn-full-width" onclick="submitLead()">Unlock My Results &rarr;</button>
        </div>
      </div>

      <!-- FINAL VIEW -->
      <div class="quiz-final quiz-view-final" id="quizFinal" style="display:none;">
        <h2 class="quiz-question quiz-final-title">Your Full Assessment</h2>
        <div class="final-result-card">
          <p id="finalResultText"></p>
        </div>
        <p class="quiz-final-text">Take the next step with expert guidance.</p>
        <div class="cta-btns flex-center">
          <a href="{{ route('frontend.contact') }}" class="btn-primary-dark">Book Free Consultation</a>
          <a href="https://wa.me/919999999999" target="_blank" class="btn-outline">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path
                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
            </svg>
            WhatsApp Now
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- FOOTER -->


  <!-- SCRIPTS -->
  <script>



    // ── QUIZ DATA ──
    const quizQuestions = @json($questions);


    let quizSteps = [];
    let currentQuizStep = 0;
    const quizAnswers = {};
    const STEP_SIZE = 8;

    // Initialize quiz steps with all questions
    for (let i = 0; i < quizQuestions.length; i += STEP_SIZE) {
      quizSteps.push(quizQuestions.slice(i, i + STEP_SIZE));
    }

    function renderQuizStep(idx) {
      currentQuizStep = idx;
      const qs = quizSteps[idx];


      const qStart = idx * STEP_SIZE + 1;
      const qEnd = Math.min(qStart + qs.length - 1, quizQuestions.length);
      document.getElementById('quizStepText').textContent = 'Step ' + (idx + 1) + ' of ' + quizSteps.length;
      document.getElementById('quizStepSubtitle').textContent =
        'Questions ' + qStart + ' – ' + qEnd + '  ·  ' + 'Comprehensive Assessment';

      document.getElementById('quizBtnBack').style.display = idx > 0 ? 'inline-block' : 'none';

      const container = document.getElementById('quizRows');
      container.innerHTML = '';
      qs.forEach(q => {
        const isFemale = q.gender === 'f';
        const genderBadge = isFemale
          ? '<span class="q-gender-badge badge-female">Question for Female</span>'
          : '<span class="q-gender-badge badge-male">Question for Male</span>';

        const row = document.createElement('div');
        row.className = 'quiz-row';
        row.innerHTML =
          '<div class="quiz-row-main">' +
          '<span class="quiz-row-text">' + q.question + '</span>' +
          '<div class="quiz-row-footer">' + genderBadge + '</div>' +
          '</div>' +
          '<div class="quiz-row-opts">' +
          '<button class="quiz-inline-btn" data-id="' + q.id + '" data-val="Yes" onclick="quizPick(this)">Yes</button>' +
          '<button class="quiz-inline-btn" data-id="' + q.id + '" data-val="No"  onclick="quizPick(this)">No</button>' +
          '</div>';
        container.appendChild(row);
      });

      // Restore previously saved answers
      qs.forEach(q => {
        if (quizAnswers[q.id]) {
          document.querySelectorAll('[data-id="' + q.id + '"]').forEach(btn => {
            if (btn.dataset.val === quizAnswers[q.id]) {
              btn.classList.add(quizAnswers[q.id] === 'Yes' ? 'selected-yes' : 'selected-no');
            }
          });
        }
      });

      quizCheckComplete();
      quizUpdateProgress();
    }

    function quizPick(btn) {
      const id = btn.dataset.id;
      const val = btn.dataset.val;
      quizAnswers[id] = val;
      document.querySelectorAll('[data-id="' + id + '"]').forEach(b => b.classList.remove('selected-yes', 'selected-no'));
      btn.classList.add(val === 'Yes' ? 'selected-yes' : 'selected-no');
      quizCheckComplete();
    }

    function quizCheckComplete() {
      const qs = quizSteps[currentQuizStep];
      if (!qs) return;
      const done = qs.every(q => quizAnswers[q.id]);
      document.getElementById('quizBtnNext').disabled = !done;
      document.getElementById('quizNavInfo').textContent = done ? 'All answered ✓' : 'Answer all questions to continue';
    }

    function quizUpdateProgress() {
      const totalSteps = quizSteps.length;
      const pct = (currentQuizStep / totalSteps) * 100;
      document.getElementById('quizProgressBar').style.width = pct + '%';
    }

    function quizGoNext() {
      if (currentQuizStep < quizSteps.length - 1) {
        currentQuizStep++;
        renderQuizStep(currentQuizStep);
        window.scrollTo({ top: document.querySelector('.quiz-section').offsetTop - 20, behavior: 'smooth' });
      } else {
        document.getElementById('quizProgressBar').style.width = '90%';
        document.getElementById('quizFormView').style.display = 'none';
        document.getElementById('quizTeaserView').style.display = 'block';
      }
    }

    function quizGoBack() {
      if (currentQuizStep > 0) {
        currentQuizStep--;
        renderQuizStep(currentQuizStep);
      }
    }

    function showLeadView() {
      document.getElementById('quizTeaserView').style.display = 'none';
      document.getElementById('quizLeadView').style.display = 'block';
    }

    function submitLead() {
      const name = document.getElementById('leadName').value.trim();
      const phone = document.getElementById('leadPhone').value.trim();
      const email = document.getElementById('leadEmail').value.trim();
      const city = document.getElementById('leadCity').value.trim();

      if (!name || !phone) { alert('Please enter at least your Name and Phone Number.'); return; }

      const submitBtn = event.target;
      submitBtn.disabled = true;
      submitBtn.textContent = 'Processing...';

      fetch('{{ route('frontend.quiz.submit') }}', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
              name: name,
              phone: phone,
              email: email,
              city: city,
              answers: quizAnswers
          })
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              document.getElementById('finalResultText').textContent = data.message;
              document.getElementById('quizProgressBar').style.width = '100%';
              document.getElementById('quizLeadView').style.display = 'none';
              document.getElementById('quizFinal').style.display = 'block';
          } else {
              alert('Something went wrong. Please try again.');
              submitBtn.disabled = false;
              submitBtn.textContent = 'Unlock My Results &rarr;';
          }
      })
      .catch(error => {
          console.error('Error:', error);
          alert('Failed to submit. Check your connection.');
          submitBtn.disabled = false;
          submitBtn.textContent = 'Unlock My Results &rarr;';
      });
    }

    document.addEventListener('DOMContentLoaded', () => {
      renderQuizStep(0);
    });
  </script>
@endsection