frontend/src/app/volunteer/page.js

import { getUserRole } from "@/lib/auth";
import Volunteer from "@/components/volunteer/landing";
import VolunteerManagement from "@/components/volunteer/VolunteerManagement";
import CaseOfficerDashboard from "@/components/dashboard/caseOfficer/CaseOfficerDashboard";
import VolunteerDashboard from "@/components/dashboard/volunteer/VolunteerDashboard";

// VolunteerApplication-related pages (you can rename based on your structure)
import ApplyApplicationForm from "@/components/volunteer/ApplyApplicationForm";
// import ApplicationStatus from "@/components/volunteer/ApplicationStatus";
// import ApplicationManagement from "@/components/volunteer/ApplicationManagement";

export default async function DashboardPage() {
  const role = await getUserRole();

  // Main system roles
  if (role === "admin") return <VolunteerManagement />;
//   if (role === "case_officer") return <CaseOfficerDashboard />;
//   if (role === "volunteer") return <VolunteerDashboard />;
  if (role === "complainant") return <ApplyApplicationForm />;

  return <p>Unauthorized</p>;
}

frontend/src/components/volunteer/landing.js
<I want the code here>

frontend/src/components/volunteer/ApplyApplicationForm.js
"use client";

import { useState, useRef } from "react";
import styles from "./ApplyApplicationForm.module.css";

// ── Step definitions ──────────────────────────────────────────────────────────
const STEPS = [
  { id: 0, label: "Applicant's Info" },
  { id: 1, label: "Screening Questions" },
  { id: 2, label: "Essay" },
  { id: 3, label: "Supporting Credentials" },
  { id: 4, label: "Review & Submit" },
];

// ── Wizard Progress Bar ───────────────────────────────────────────────────────
function WizardStepper({ current }) {
  return (
    <div className={styles.wizardStepper}>
      {STEPS.map((step, i) => {
        const done   = i < current;
        const active = i === current;
        return (
          <div key={step.id} className={styles.wizardStepItem}>
            {i > 0 && (
              <div className={`${styles.wizardLine} ${done ? styles.wizardLineDone : ""}`} />
            )}
            <div
              className={`${styles.wizardDot}
                ${active ? styles.wizardDotActive : ""}
                ${done   ? styles.wizardDotDone  : ""}`}
            >
              {done ? "✓" : i + 1}
            </div>
            <span className={`${styles.wizardLabel} ${active ? styles.wizardLabelActive : ""} ${done ? styles.wizardLabelDone : ""}`}>
              {step.label}
            </span>
          </div>
        );
      })}
    </div>
  );
}

// ── Shared field components ───────────────────────────────────────────────────
function Field({ label, children, required }) {
  return (
    <div className={styles.field}>
      <label className={styles.fieldLabel}>
        {label}{required && <span className={styles.required}>*</span>}
      </label>
      {children}
    </div>
  );
}

function Input({ ...props }) {
  return <input className={styles.input} {...props} />;
}

function Select({ children, ...props }) {
  return (
    <select className={styles.select} {...props}>
      {children}
    </select>
  );
}

function RadioGroup({ name, options, value, onChange }) {
  return (
    <div className={styles.radioGroup}>
      {options.map((opt) => (
        <label key={opt} className={styles.radioLabel}>
          <input
            type="radio"
            name={name}
            value={opt}
            checked={value === opt}
            onChange={() => onChange(opt)}
            className={styles.radioInput}
          />
          {opt}
        </label>
      ))}
    </div>
  );
}

// ── Page 1 — Applicant's Information ───────────────────────────────────────
function StepApplicantInfo({ data, onChange }) {
  const set = (key) => (e) => onChange({ ...data, [key]: e.target.value });
  return (
    <div>
      <h2 className={styles.stepTitle}>
        <span className={styles.stepTitleAccent}>Applicant's</span> Information
      </h2>
      <p className={styles.stepDesc}>
        Please provide your personal details. All information is kept strictly confidential.
      </p>

      <div className={styles.formGrid}>
        <Field label="Name" required>
          <Input placeholder="Full name" value={data.name} onChange={set("name")} />
        </Field>
        <Field label="Age" required>
          <Input type="number" placeholder="Age" value={data.age} onChange={set("age")} />
        </Field>
        <Field label="Gender Identity">
          <Select value={data.gender} onChange={set("gender")}>
            <option value="">Select gender identity</option>
            <option>Male</option>
            <option>Female</option>
            <option>Non-binary</option>
            <option>Prefer not to say</option>
          </Select>
        </Field>
        <Field label="Organization">
          <Select value={data.organization} onChange={set("organization")}>
            <option value="">Select organization</option>
            <option>BSP Unit</option>
            <option>GSPH Troop</option>
            <option>Other</option>
          </Select>
        </Field>
      </div>

      <div className={styles.formDivider} />
      <h3 className={styles.subSectionTitle}>Mode of Contact</h3>
      <div className={styles.formGrid}>
        <Field label="Contact Number" required>
          <Input placeholder="09XX-XXX-XXXX" value={data.contactNumber} onChange={set("contactNumber")} />
        </Field>
        <Field label="Email" required>
          <Input type="email" placeholder="sample@gmail.com" value={data.email} onChange={set("email")} />
        </Field>
      </div>

      <div className={styles.formDivider} />
      <h3 className={styles.subSectionTitle}>Consent</h3>
      <Field label="Willingness to be interviewed by a SASHA Representative">
        <RadioGroup
          name="interview"
          options={["Yes", "No"]}
          value={data.interview}
          onChange={(v) => onChange({ ...data, interview: v })}
        />
      </Field>
    </div>
  );
}

// ── Page 2 — Screening Questions ───────────────────────────────────────────────
function StepScreeningQuestions({ data, onChange }) {
  const set = (key) => (e) => onChange({ ...data, [key]: e.target.value });
  const setRadio = (key) => (v) => onChange({ ...data, [key]: v });
  return (
    <div>
      <h2 className={styles.stepTitle}>
        <span className={styles.stepTitleAccent}>Screening Questions</span>
      </h2>
      <p className={styles.stepDesc}>
        Please answer the following questions truthfully and honestly.
      </p>
      

        <div className={styles.radioColumn}>
          <Field label="Is the perpetrator known?">
            <RadioGroup name="perpetratorKnown" options={["Yes", "No"]} value={data.perpetratorKnown} onChange={setRadio("perpetratorKnown")} />
          </Field>
          <Field label="Are there any witnesses?">
            <RadioGroup name="witnesses" options={["Yes", "No"]} value={data.witnesses} onChange={setRadio("witnesses")} />
          </Field>
          <Field label="Have you told anyone about the incident?">
            <RadioGroup name="toldAnyone" options={["Yes", "No"]} value={data.toldAnyone} onChange={setRadio("toldAnyone")} />
          </Field>
          <Field label="Have you told the police?">
            <RadioGroup name="toldPolice" options={["Yes", "No"]} value={data.toldPolice} onChange={setRadio("toldPolice")} />
          </Field>
        </div>
    </div>
  );
}

// ── Page 3 — Essay ─────────────────────────────────────────────────
function StepEssay({ data, onChange }) {
  const set = (key) => (e) => onChange({ ...data, [key]: e.target.value });
  const setRadio = (key) => (v) => onChange({ ...data, [key]: v });

  return (
    <div>
      <h2 className={styles.stepTitle}>
        <span className={styles.stepTitleAccent}>Essay</span>
      </h2>
      <p className={styles.stepDesc}>
        Please answer truthfully and honestly.
      </p>
      

      <div className={styles.formGrid}>
        <div>
          <Field label="Why do you want to Volunteer with SASHA?" required>
            <textarea
              className={styles.textarea}
              placeholder="Answer here..."
              value={data.description}
              onChange={set("description")}
              rows={5}
            />
          </Field>
          <p className={styles.fieldHint}>Please provide factual and clear information.</p>

          <Field label="What action or outcome are you seeking?">
            <textarea
              className={styles.textarea}
              placeholder="Describe the action or outcome you are seeking..."
              value={data.outcome}
              onChange={set("outcome")}
              rows={3}
            />
          </Field>
        </div>
      </div>
    </div>
  );
}

// ── Page 4 — Supporting Credentials ─────────────────────────────────────────────
function StepCredentials({ data, onChange }) {
  const fileInputRef = useRef();
  const [dragging, setDragging] = useState(false);

  const addFiles = (newFiles) => {
    const arr = Array.from(newFiles);
    onChange({ ...data, files: [...(data.files || []), ...arr] });
  };

  const removeFile = (idx) => {
    const updated = data.files.filter((_, i) => i !== idx);
    onChange({ ...data, files: updated });
  };

  const handleDrop = (e) => {
    e.preventDefault();
    setDragging(false);
    addFiles(e.dataTransfer.files);
  };

  return (
    <div>
      <h2 className={styles.stepTitle}>
        <span className={styles.stepTitleAccent}>Supporting</span> Credentials
      </h2>
      <p className={styles.stepDesc}>
        Please submit your Resume, Certificates, Recommendation letters, or any relevant files that can support your application.
      </p>

      <div className={styles.credentialsLayout}>
        {/* Drop zone */}
        <div
          className={`${styles.dropZone} ${dragging ? styles.dropZoneActive : ""}`}
          onClick={() => fileInputRef.current.click()}
          onDragOver={(e) => { e.preventDefault(); setDragging(true); }}
          onDragLeave={() => setDragging(false)}
          onDrop={handleDrop}
        >
          <div className={styles.dropIcon}>↑</div>
          <p className={styles.dropText}>Drag and drop to upload files</p>
          <button
            type="button"
            className={styles.browseBtn}
            onClick={(e) => { e.stopPropagation(); fileInputRef.current.click(); }}
          >
            Browse
          </button>
          <p className={styles.dropHint}>Supported files: PDF, JPG, PNG, MP4</p>
          <input
            ref={fileInputRef}
            type="file"
            multiple
            accept=".pdf,.jpg,.jpeg,.png,.mp4"
            style={{ display: "none" }}
            onChange={(e) => addFiles(e.target.files)}
          />
        </div>

        {/* File list */}
        <div className={styles.fileList}>
          <h3 className={styles.fileListTitle}>Submitted Files</h3>
          {(!data.files || data.files.length === 0) ? (
            <p className={styles.noFiles}>No files uploaded yet.</p>
          ) : (
            data.files.map((f, i) => (
              <div key={i} className={styles.fileItem}>
                <span className={styles.fileIcon}>📄</span>
                <span className={styles.fileName}>{f.name}</span>
                <button
                  type="button"
                  className={styles.fileRemove}
                  onClick={() => removeFile(i)}
                >
                  ×
                </button>
              </div>
            ))
          )}
        </div>
      </div>
    </div>
  );
}

// ── Page 5 — Review & Submit ──────────────────────────────────────────────────
function StepReview({ applicant, screeningQuestions, essay, credentials }) {
  const Row = ({ label, value }) => (
    <div className={styles.reviewRow}>
      <span className={styles.reviewLabel}>{label}</span>
      <span className={styles.reviewValue}>{value || <em className={styles.reviewEmpty}>Not provided</em>}</span>
    </div>
  );

  return (
    <div>
      <h2 className={styles.stepTitle}>
        <span className={styles.stepTitleAccent}>Review</span> & Submit
      </h2>
      <p className={styles.stepDesc}>
        Please review all information before submitting. Once submitted, your application will be handled with strict confidentiality.
      </p>

      <div className={styles.reviewSection}>
        <h3 className={styles.reviewSectionTitle}>Applicant's Information</h3>
        <Row label="Name" value={applicant.name} />
        <Row label="Age" value={applicant.age} />
        <Row label="Gender Identity" value={applicant.gender} />
        <Row label="Organization" value={applicant.organization} />
        <Row label="Willing to be interviewed" value={applicant.interview} />
        <Row label="Contact Number" value={applicant.contactNumber} />
        <Row label="Email" value={applicant.email} />
      </div>

      <div className={styles.reviewSection}>
        <h3 className={styles.reviewSectionTitle}>Screening Questions</h3>
        <Row label="Perpetrator known" value={screeningQuestions.perpetratorKnown} />
        <Row label="Witnesses" value={screeningQuestions.witnesses} />
        <Row label="Told anyone" value={screeningQuestions.toldAnyone} />
        <Row label="Told police" value={screeningQuestions.toldPolice} />
      </div>

      <div className={styles.reviewSection}>
        <h3 className={styles.reviewSectionTitle}>Essay Details</h3>
        <Row label="Description" value={essay.description} />
      </div>

      <div className={styles.reviewSection}>
        <h3 className={styles.reviewSectionTitle}>Supporting Credentials</h3>
        <Row
          label="Files attached"
          value={
            credentials.files && credentials.files.length > 0
              ? credentials.files.map((f) => f.name).join(", ")
              : "None"
          }
        />
      </div>
    </div>
  );
}

// ── Status Stepper (for application cards below) ───────────────────────────────────
function StatusStepper({ steps, current }) {
  return (
    <div className={styles.stepper}>
      {steps.map((label, i) => {
        const done   = i < current;
        const active = i === current;
        return (
          <div key={label} className={styles.stepItem}>
            {i > 0 && (
              <div className={`${styles.stepLine} ${done || active ? styles.stepLineDone : ""}`} />
            )}
            <div className={`${styles.stepDot} ${active ? styles.stepDotActive : ""} ${done ? styles.stepDotDone : ""}`} />
            <span className={`${styles.stepLabel} ${active ? styles.stepLabelActive : ""}`}>{label}</span>
          </div>
        );
      })}
    </div>
  );
}

// ── Application Status Card ────────────────────────────────────────────────────────
function ApplicationStatusCard({ applicationData, onView }) {
  const steps = ["Submitted", "Under Review", "Resolved"];
  const { description = "—", location = "—", dateApplied = "—", id = "—", currentStep = 0 } = applicationData ?? {};
  return (
    <div className={styles.statusCard}>
      <div className={styles.statusCardHeader}>
        <span>Application 2</span>
        <button className={styles.headerViewBtn} onClick={onView}>View →</button>
      </div>
      <div className={styles.statusCardBody}>
        <div className={styles.applicationMetaRow}>
          <div>
            <p className={styles.statusMeta}>Description: {description}</p>
            <p className={styles.statusMeta}>Location: {location}</p>
            <p className={styles.statusMeta}>Date Applied: {dateApplied}</p>
          </div>
          <span className={styles.applicationId}>ID: {id}</span>
        </div>
        <StatusStepper steps={steps} current={currentStep} />
      </div>
    </div>
  );
}

// ── Main Page Component ───────────────────────────────────────────────────────
export default function CreateApplication({
  applicationData = null,
  notifications   = [],
  events          = [],
}) {
  const [step, setStep]   = useState(0);
  const [submitted, setSubmitted] = useState(false);

  const [applicant, setApplicant] = useState({
    name: "", age: "", gender: "", organization: "",
    interview: "", contactNumber: "", email: "",
  });
  const [screeningQuestions, setScreeningQuestions] = useState({
  perpetratorKnown: "", witnesses: "",
    toldAnyone: "", toldPolice: "",
});
  const [essay, setEssay] = useState({
    description: "",
  });
  const [credentials, setCredentials] = useState({ files: []});

  const totalSteps = STEPS.length;

  const handleNext = () => {
    if (step < totalSteps - 1) setStep((s) => s + 1);
  };
  const handleBack = () => {
    if (step > 0) setStep((s) => s - 1);
  };
  const handleSubmit = () => setSubmitted(true);

  // ── Demo fallback data for status cards ───────────────────────────────────
  const resolvedApplication = applicationData ?? {
    description: "Lorem Ipsum Dolor",
    location: "123 Metro Manila",
    dateApplied: "March 3, 2026",
    id: "00111222333",
    currentStep: 0,
  };

  const resolvedApplication2 = {
    description: "Lorem Ipsum Dolor",
    location: "123 Metro Manila",
    dateApplied: "Feb 24, 2026",
    id: "00111222333",
    currentStep: 1,
  };

  return (
    <main className={styles.pageWrapper}>
        <div className={styles.pageInner}>
      <div className="container-xl py-5">

        {/* ── HERO ── */}
        <section className={styles.hero}>
          <div className={styles.heroInner}>
            <div className={styles.heroContent}>
              <p className={styles.heroEyebrow}>
                <span className={styles.heroLine} />
                Submit a Application
              </p>
              <h1 className={styles.heroTitle}>
                We're Here
                <span className={styles.heroTitleAccent}> to Help</span>
              </h1>
              <p className={styles.heroDesc}>
                Please provide accurate and detailed information. All applications are handled with strict confidentiality.
              </p>
            </div>
          </div>
        </section>

        {/* ── Paginated Form Card ── */}
        {!submitted ? (
          <div className={styles.formCard}>
            {/* Form card header */}
            <div className={styles.formCardHeader}>
              <div className={styles.formCardHeaderLines}>
                <div className={styles.formCardHeaderLine} />
              </div>
              <h2 className={styles.formCardTitle}>Application Submission Form</h2>
              <div className={styles.formCardHeaderLines}>
                <div className={styles.formCardHeaderLine} />
              </div>
            </div>

            {/* Wizard stepper */}
            <WizardStepper current={step} />

            {/* Step content */}
            <div className={styles.formBody}>
              {step === 0 && <StepApplicantInfo data={applicant} onChange={setApplicant} />}
              {step === 1 && <StepScreeningQuestions data={screeningQuestions} onChange={setScreeningQuestions} />}
              {step === 2 && <StepEssay data={essay} onChange={setEssay} />}
              {step === 3 && <StepCredentials        data={credentials}    onChange={setCredentials}    />}
              {step === 4 && <StepReview applicant={applicant} screeningQuestions={screeningQuestions} essay={essay} credentials={credentials} />}
            </div>

            {/* Navigation buttons */}
            <div className={styles.formNav}>
              {step > 0 ? (
                <button type="button" className={styles.backBtn} onClick={handleBack}>
                  ← Back
                </button>
              ) : <div />}

              {step < totalSteps - 1 ? (
                <button type="button" className={styles.nextBtn} onClick={handleNext}>
                  Next →
                </button>
              ) : (
                <button type="button" className={styles.submitBtn} onClick={handleSubmit}>
                  Submit Application
                </button>
              )}
            </div>
          </div>
        ) : (
          <div className={styles.successCard}>
            <div className={styles.successIcon}>✓</div>
            <h2 className={styles.successTitle}>Application Submitted!</h2>
            <p className={styles.successDesc}>
              Your application has been received. We will review it and get back to you via your provided contact details.
              All information is handled with strict confidentiality.
            </p>
            <button className={styles.submitBtn} onClick={() => { setSubmitted(false); setStep(0); }}>
              Submit Another Application
            </button>
          </div>
        )}

        {/* ── Your Application Status ── */}
        <div className={`${styles.sectionHeading} mt-5`}>
          <h2 className={styles.sectionTitle}>Your Application Status</h2>
          <div className={styles.headingLine} />
        </div>

        <div className="row g-3">
          <div className="col-12">
            <ApplicationStatusCard applicationData={resolvedApplication} onView={() => {}} />
          </div>
          <div className="col-12">
            <ApplicationStatusCard applicationData={resolvedApplication2} onView={() => {}} />
          </div>
        </div>
        </div>
      </div>
    </main>
  );
}


frontend/src/components/volunteer/ApplyApplicationForm.module.css
/* ════════════════════════════════════════
   SASHA Design tokens
   ════════════════════════════════════════ */
:root {
  --sasha-teal:         #037F81;
  --sasha-teal-dark:    #025f61;
  --sasha-teal-light:   #e1f5f5;
  --sasha-orange:       #E8663A;
  --sasha-orange-dark:  #c44e24;
  --sasha-white:        #ffffff;
  --sasha-offwhite:     #f5f7f8;
  --sasha-text:         #1a1a1a;
  --sasha-muted:        #6b7280;
  --sasha-border:       #e5e7eb;
  --sasha-card-radius:  14px;
}

/* ════════════════════════════════════════
   PAGE WRAPPER
   ════════════════════════════════════════ */
.pageWrapper {
  background: var(--sasha-offwhite);
  min-height: 100vh;
  color: var(--sasha-text);
  padding-top: 2rem;

  display: flex;
  justify-content: center;
}

.pageInner {
  max-width: 1200px;
  width: 100%;
}

/* ════════════════════════════════════════
   HERO BANNER
   ════════════════════════════════════════ */
.hero {
  position: relative;
  width: 100%;
  overflow: hidden;
  display: flex;
  align-items: center;
}

.heroInner {
  position: relative;
  z-index: 1;
  width: 100%;
  margin: 0 auto;
  padding: 2rem 2rem 5rem;
  display: flex;
  align-items: center;
  gap: 3rem;
}

.heroContent {
  flex: 1 1 0;
  min-width: 0;
}

.heroEyebrow {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--sasha-muted);
  margin-bottom: 1rem;
  text-transform: uppercase;
  letter-spacing: 0.06em;
}

.heroLine {
  display: inline-block;
  width: 28px;
  height: 3px;
  background: var(--sasha-orange);
  border-radius: 2px;
  flex-shrink: 0;
}

.heroTitle {
  font-size: clamp(2rem, 5vw, 3.4rem);
  font-weight: 800;
  color: var(--sasha-teal);
  line-height: 1.15;
  margin-bottom: 1.25rem;
}

.heroTitleAccent {
  color: var(--sasha-orange);
}

.heroDesc {
  font-size: clamp(0.88rem, 1.5vw, 1rem);
  color: var(--sasha-muted);
  line-height: 1.75;
  margin-bottom: 2rem;
  max-width: 1200px;
}

/* ════════════════════════════════════════
   SECTION HEADING
   ════════════════════════════════════════ */
.sectionHeading {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.25rem;
}

.sectionTitle {
  font-size: 1.3rem;
  font-weight: 800;
  color: var(--sasha-text);
  white-space: nowrap;
  margin: 0;
}

.headingLine {
  flex: 1;
  height: 2px;
  background: linear-gradient(to right, var(--sasha-orange), transparent);
  border-radius: 2px;
}

/* ════════════════════════════════════════
   FORM CARD  (paginated wizard)
   ════════════════════════════════════════ */
.formCard {
  background: var(--sasha-white);
  border-radius: var(--sasha-card-radius);
  border: 1px solid var(--sasha-border);
  overflow: hidden;
  box-shadow: 0 4px 24px rgba(0,0,0,0.06);
  margin-bottom: 1rem;
}

/* Teal header bar with decorative lines */
.formCardHeader {
  background: var(--sasha-teal);
  padding: 1.1rem 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1rem;
}

.formCardTitle {
  font-size: 1.05rem;
  font-weight: 800;
  color: var(--sasha-white);
  margin: 0;
  letter-spacing: 0.02em;
  white-space: nowrap;
}

.formCardHeaderLines {
  display: flex;
  flex-direction: column;
  gap: 4px;
  flex: 1;
}

.formCardHeaderLine {
  height: 2px;
  background: var(--sasha-white);
  border-radius: 2px;
}

/* ── Wizard Stepper ── */
.wizardStepper {
  display: flex;
  align-items: flex-start;
  padding: 1.5rem 2rem 0.5rem;
  gap: 0;
  position: relative;
}

.wizardStepItem {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;
  position: relative;
}

.wizardLine {
  position: absolute;
  top: 17px;
  left: calc(-50%);
  width: 100%;
  height: 2px;
  background: var(--sasha-border);
  z-index: 0;
  transition: background 0.3s;
}

.wizardLineDone {
  background: var(--sasha-teal);
}

.wizardDot {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: var(--sasha-white);
  border: 2px solid var(--sasha-border);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--sasha-muted);
  z-index: 1;
  position: relative;
  transition: all 0.25s;
}

.wizardDotActive {
  background: var(--sasha-orange) !important;
  border-color: var(--sasha-orange) !important;
  color: var(--sasha-white) !important;
  box-shadow: 0 0 0 4px rgba(232,102,58,0.18);
}

.wizardDotDone {
  background: var(--sasha-teal) !important;
  border-color: var(--sasha-teal) !important;
  color: var(--sasha-white) !important;
}

.wizardLabel {
  font-size: 0.72rem;
  color: var(--sasha-muted);
  margin-top: 0.45rem;
  text-align: center;
  line-height: 1.25;
  font-weight: 500;
  max-width: 90px;
}

.wizardLabelActive {
  color: var(--sasha-orange);
  font-weight: 700;
}

.wizardLabelDone {
  color: var(--sasha-teal);
  font-weight: 600;
}

/* ── Form body ── */
.formBody {
  padding: 1.75rem 2rem;
  animation: fadeSlide 0.22s ease;
}

@keyframes fadeSlide {
  from { opacity: 0; transform: translateY(8px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ── Step title ── */
.stepTitle {
  font-size: 1.35rem;
  font-weight: 800;
  color: var(--sasha-teal);
  margin: 0 0 0.35rem;
}

.stepTitleAccent {
  color: var(--sasha-orange);
}

.stepDesc {
  font-size: 0.875rem;
  color: var(--sasha-muted);
  margin: 0 0 1.5rem;
  line-height: 1.6;
  max-width: 700px;
}

/* ── Sub section title ── */
.subSectionTitle {
  font-size: 1rem;
  font-weight: 800;
  color: var(--sasha-teal);
  margin: 0 0 0.85rem;
}

/* ── Form grid layouts ── */
.formGrid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem 1.5rem;
  margin-bottom: 0.5rem;
}

.formGrid3 {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 1rem 1.5rem;
  margin-bottom: 0.25rem;
}

.formDivider {
  height: 1px;
  background: var(--sasha-border);
  margin: 1.25rem 0;
}

/* ── Field ── */
.field {
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
}

.fieldLabel {
  font-size: 0.82rem;
  font-weight: 600;
  color: var(--sasha-text);
}

.required {
  color: var(--sasha-orange);
  margin-left: 2px;
}

.fieldHint {
  font-size: 0.72rem;
  color: var(--sasha-muted);
  margin: 0.2rem 0 0.9rem;
  font-style: italic;
}

/* ── Input / Select ── */
.input,
.select,
.textarea {
  width: 100%;
  padding: 0.55rem 0.75rem;
  border: 1px solid var(--sasha-border);
  border-radius: 8px;
  font-size: 0.85rem;
  color: var(--sasha-text);
  background: var(--sasha-white);
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
  font-family: inherit;
}

.input:focus,
.select:focus,
.textarea:focus {
  border-color: var(--sasha-teal);
  box-shadow: 0 0 0 3px rgba(3,127,129,0.12);
}

.input::placeholder,
.textarea::placeholder {
  color: #b0b8c1;
}

.textarea {
  resize: vertical;
  line-height: 1.6;
}

/* ── Radio ── */
.radioGroup {
  display: flex;
  gap: 1.25rem;
  margin-top: 0.1rem;
}

.radioLabel {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 0.85rem;
  color: var(--sasha-text);
  cursor: pointer;
}

.radioInput {
  accent-color: var(--sasha-teal);
  width: 16px;
  height: 16px;
  cursor: pointer;
}

/* ── Radio column (incident page right side) ── */
.radioColumn {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

/* ── Credentials Upload ── */
.credentialsLayout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}

.dropZone {
  border: 2px dashed var(--sasha-border);
  border-radius: 10px;
  padding: 2rem 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  cursor: pointer;
  transition: border-color 0.2s, background 0.2s;
  text-align: center;
  min-height: 200px;
}

.dropZone:hover,
.dropZoneActive {
  border-color: var(--sasha-teal);
  background: var(--sasha-teal-light);
}

.dropIcon {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  border: 2px solid var(--sasha-border);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  color: var(--sasha-muted);
  margin-bottom: 0.25rem;
}

.dropText {
  font-size: 0.85rem;
  color: var(--sasha-muted);
  margin: 0;
}

.browseBtn {
  background: var(--sasha-teal);
  color: var(--sasha-white);
  border: none;
  border-radius: 8px;
  padding: 0.45rem 1.4rem;
  font-size: 0.82rem;
  font-weight: 700;
  cursor: pointer;
  margin-top: 0.25rem;
  transition: background 0.15s;
}

.browseBtn:hover { background: var(--sasha-teal-dark); }

.dropHint {
  font-size: 0.72rem;
  color: var(--sasha-muted);
  margin: 0;
}

.fileList {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.fileListTitle {
  font-size: 0.88rem;
  font-weight: 700;
  color: var(--sasha-teal);
  margin: 0 0 0.5rem;
}

.noFiles {
  font-size: 0.82rem;
  color: var(--sasha-muted);
  margin: 0;
}

.fileItem {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--sasha-offwhite);
  border: 1px solid var(--sasha-border);
  border-radius: 7px;
  padding: 0.45rem 0.7rem;
}

.fileIcon { font-size: 1rem; }

.fileName {
  flex: 1;
  font-size: 0.8rem;
  color: var(--sasha-text);
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.fileRemove {
  background: none;
  border: none;
  color: var(--sasha-muted);
  font-size: 1.1rem;
  cursor: pointer;
  padding: 0 2px;
  line-height: 1;
  transition: color 0.15s;
}

.fileRemove:hover { color: var(--sasha-orange); }

/* ── Anonymous checkbox ── */
.anonymousRow {
  margin-top: 0.5rem;
}

.checkboxLabel {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  font-size: 0.88rem;
  color: var(--sasha-text);
  cursor: pointer;
  font-weight: 500;
}

.checkbox {
  width: 18px;
  height: 18px;
  accent-color: var(--sasha-teal);
  cursor: pointer;
}

/* ── Review step ── */
.reviewSection {
  border: 1px solid var(--sasha-border);
  border-radius: 10px;
  overflow: hidden;
  margin-bottom: 1rem;
}

.reviewSectionTitle {
  font-size: 0.88rem;
  font-weight: 800;
  color: var(--sasha-white);
  background: var(--sasha-teal);
  margin: 0;
  padding: 0.6rem 1rem;
}

.reviewRow {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding: 0.55rem 1rem;
  border-bottom: 1px solid var(--sasha-border);
  font-size: 0.82rem;
}

.reviewRow:last-child { border-bottom: none; }

.reviewLabel {
  color: var(--sasha-muted);
  min-width: 160px;
  font-weight: 600;
  flex-shrink: 0;
}

.reviewValue {
  color: var(--sasha-text);
  flex: 1;
  word-break: break-word;
}

.reviewEmpty {
  color: #b0b8c1;
  font-style: italic;
}

/* ── Form navigation buttons ── */
.formNav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem 1.5rem;
  border-top: 1px solid var(--sasha-border);
}

.backBtn {
  background: transparent;
  border: 1.5px solid var(--sasha-border);
  color: var(--sasha-muted);
  border-radius: 999px;
  padding: 0.5rem 1.5rem;
  font-size: 0.85rem;
  font-weight: 700;
  cursor: pointer;
  transition: border-color 0.15s, color 0.15s;
}

.backBtn:hover {
  border-color: var(--sasha-teal);
  color: var(--sasha-teal);
}

.nextBtn {
  background: var(--sasha-teal);
  color: var(--sasha-white);
  border: none;
  border-radius: 999px;
  padding: 0.55rem 2rem;
  font-size: 0.88rem;
  font-weight: 700;
  cursor: pointer;
  transition: background 0.15s, transform 0.1s;
}

.nextBtn:hover {
  background: var(--sasha-teal-dark);
  transform: translateY(-1px);
}

.submitBtn {
  background: var(--sasha-orange);
  color: var(--sasha-white);
  border: none;
  border-radius: 999px;
  padding: 0.65rem 2.5rem;
  font-size: 0.92rem;
  font-weight: 800;
  cursor: pointer;
  transition: background 0.15s, transform 0.1s;
  letter-spacing: 0.01em;
}

.submitBtn:hover {
  background: var(--sasha-orange-dark);
  transform: translateY(-1px);
}

/* ── Success state ── */
.successCard {
  background: var(--sasha-white);
  border-radius: var(--sasha-card-radius);
  border: 1px solid var(--sasha-border);
  padding: 3rem 2rem;
  text-align: center;
  margin-bottom: 1rem;
}

.successIcon {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  background: var(--sasha-teal);
  color: var(--sasha-white);
  font-size: 1.8rem;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.25rem;
}

.successTitle {
  font-size: 1.5rem;
  font-weight: 800;
  color: var(--sasha-teal);
  margin: 0 0 0.75rem;
}

.successDesc {
  font-size: 0.9rem;
  color: var(--sasha-muted);
  max-width: 480px;
  margin: 0 auto 1.75rem;
  line-height: 1.7;
}

/* ════════════════════════════════════════
   SHARED CARD HEADER  (teal bar + optional View btn)
   ════════════════════════════════════════ */
.statusCardHeader {
  background: var(--sasha-teal);
  padding: 0.55rem 1rem;
  font-size: 0.88rem;
  font-weight: 700;
  color: var(--sasha-white);
  border-radius: var(--sasha-card-radius) var(--sasha-card-radius) 0 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.headerViewBtn {
  background: var(--sasha-white);
  color: var(--sasha-teal);
  border: none;
  border-radius: 999px;
  padding: 3px 14px;
  font-size: 0.75rem;
  font-weight: 700;
  cursor: pointer;
  transition: opacity 0.15s;
}

.headerViewBtn:hover { opacity: 0.85; }

/* ════════════════════════════════════════
   STATUS CARDS  (Report cards below)
   ════════════════════════════════════════ */
.statusCard {
  background: var(--sasha-white);
  border-radius: var(--sasha-card-radius);
  border: 1px solid var(--sasha-border);
  overflow: hidden;
}

.statusCardBody {
  padding: 1rem 1.25rem 1.25rem;
}

.reportMetaRow {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 0.5rem;
}

.reportId {
  font-size: 0.82rem;
  color: var(--sasha-muted);
  font-weight: 600;
}

.statusMeta {
  font-size: 0.82rem;
  color: var(--sasha-text);
  margin: 0 0 0.2rem;
}

/* ── Stepper ── */
.stepper {
  display: flex;
  align-items: flex-start;
  margin-top: 1.25rem;
  position: relative;
}

.stepItem {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  flex: 1;
}

.stepLine {
  position: absolute;
  top: 10px;
  left: calc(-50%);
  right: 50%;
  height: 2px;
  background: var(--sasha-border);
  z-index: 0;
  width: 100%;
}

.stepLineDone { background: var(--sasha-teal); }

.stepDot {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: var(--sasha-border);
  border: 2px solid var(--sasha-border);
  z-index: 1;
  flex-shrink: 0;
  transition: background 0.2s, border-color 0.2s;
}

.stepDotDone {
  background: var(--sasha-teal);
  border-color: var(--sasha-teal);
}

.stepDotActive {
  background: var(--sasha-orange) !important;
  border-color: var(--sasha-orange) !important;
  box-shadow: 0 0 0 3px rgba(232,102,58,0.2);
}

.stepLabel {
  font-size: 0.72rem;
  color: var(--sasha-muted);
  margin-top: 0.4rem;
  text-align: center;
  line-height: 1.2;
}

.stepLabelActive {
  color: var(--sasha-text);
  font-weight: 700;
}

/* ════════════════════════════════════════
   RESPONSIVE
   ════════════════════════════════════════ */
@media (max-width: 767.98px) {
  .heroTitle   { font-size: 1.5rem; margin-bottom: 1.25rem; }
  .formBody    { padding: 1.25rem 1rem; }
  .formNav     { padding: 1rem 1rem 1.25rem; }
  .formGrid    { grid-template-columns: 1fr; }
  .formGrid3   { grid-template-columns: 1fr; }
  .credentialsLayout { grid-template-columns: 1fr; }
  .wizardStepper  { padding: 1rem 0.5rem 0.25rem; }
  .wizardLabel    { font-size: 0.62rem; max-width: 60px; }
  .wizardDot      { width: 28px; height: 28px; font-size: 0.72rem; }
  .reviewLabel    { min-width: 110px; }
}

frontend/src/app/page.js
"use client";

import { useState } from "react";
import styles from "./page.module.css";
import { FiArrowRight, FiMenu, FiX } from "react-icons/fi";

export default function Landing() {
  const [menuOpen, setMenuOpen] = useState(false);
  const steps = [
    {
      step: "Step 1",
      title: "Register",
      desc: "Create a secure account to access reporting and support features",
      active: true,
    },
    {
      step: "Step 2",
      title: "Submit a Report",
      desc: "Registered users may file a detailed incident report through a structured form",
      active: false,
    },
    {
      step: "Step 3",
      title: "Case Review",
      desc: "Case officers verify and evaluate reports following confidentiality protocols",
      active: false,
    },
    {
      step: "Step 4",
      title: "Case Monitoring",
      desc: "Users may track the status of their submitted reports through their dashboard",
      active: false,
    },
  ];

  return (
    <div className={styles.pageWrapper}>

      {/* ── HERO ── */}
      <section className={styles.hero}>

        {/* Background image */}
        <div className={styles.heroBg}>
          <img src="/sasha-bg-2.png" alt="" aria-hidden="true" />
        </div>

        <div className={styles.heroInner}>

          {/* Text block */}
          <div className={styles.heroContent}>
            <p className={styles.heroEyebrow}>
              <span className={styles.heroLine} />
              Scouts Against Sexual Harassment and Abuse
            </p>
            <h1 className={styles.heroTitle}>
              Break the Silence<br />
              <span className={styles.heroTitleAccent}>Stand for Justice</span>
            </h1>
            <p className={styles.heroDesc}>
              Scouts Against Sexual Harassment and Abuse (SASHA) is a Scout-led
              civil society organization dedicated to protecting children, women,
              youth, and LGBTQIA+ individuals from sexual harassment and abuse.
            </p>
            <div className={styles.heroBtns}>
              <a href="/signup" className={styles.btnPrimary}>Create an Account</a>
              <a href="/volunteer" className={styles.btnOutline}>Be a Volunteer</a>
            </div>
          </div>

          {/* Hero card image */}
          <div className={styles.heroImage}>
            <img src="/sasha-hero-card.png" alt="You are safe with SASHA" />
          </div>

        </div>
      </section>

      {/* ── COMMITMENT ── */}
      <section className={styles.commitment}>
        <div className={styles.sectionInner}>
          <p className={styles.sectionEyebrow}>
            <span className={styles.eyebrowLine} /> What We Do
          </p>
          <div className={styles.commitmentHeader}>
            <h2 className={styles.sectionTitle}>Our <span className={styles.howTitleAccent}>Commitment</span></h2>
            <a href="/about" className={styles.learnMoreBtn}>
              Learn More <FiArrowRight />
            </a>
          </div>
          <p className={styles.commitmentDesc}>
            SASHA provides a platform for reporting cases of sexual harassment
            and abuse. Beyond case handling, SASHA actively promotes gender
            equality, youth empowerment, and accountability within and beyond
            the Scouting movement.
          </p>
          <div className={styles.commitmentGrid}>
            <div className={styles.commitmentImgWrap}>
              <img src="/sasha-commitment.png" alt="SASHA community" />
            </div>
            <div className={styles.commitmentCard}>
              <p>
                SASHA ensures that all reports are handled with{" "}
                <strong>confidentiality and responsibly</strong> through
                verification, evaluation, and proper case management procedures
              </p>
              <div className={styles.commitmentCardIcon}>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" width="24" height="24">
                  <circle cx="12" cy="12" r="10" />
                  <polyline points="9 12 11 14 15 10" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── HOW WE GET IT DONE ── */}
      <section className={styles.howItWorks}>
        <div className={styles.howBg}>
          <img src="/sasha-bg-1.png" alt="" aria-hidden="true" />
          <div className={styles.howBgOverlay} />
        </div>

        <div className={styles.sectionInner}>
          <div className={styles.howHeader}>
            <div>
              <p className={styles.sectionEyebrowLight}>
                <span className={styles.eyebrowLineLight} /> How SASHA Works
              </p>
              <h2 className={styles.sectionTitleLight}>
                How We <span className={styles.howTitleAccent}>Get It Done</span>
              </h2>
            </div>
            <a href="/about" className={styles.learnMoreBtnLight}>
              Learn More <FiArrowRight />
            </a>
          </div>

          <div className={styles.stepsContainer}>
            <div className={styles.timelineRow}>
              <div className={styles.timelineLine} />
              {steps.map((s, i) => (
                <div key={`badge-${i}`} className={styles.badgeWrapper}>
                  <span className={s.active ? styles.stepBadgeActive : styles.stepBadge}>
                    {s.step}
                  </span>
                  {i < steps.length - 1 && (
                    <span className={styles.stepArrow}>
                      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet">
                        <path d="M7 7L12 12L7 17" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                        <path d="M13 7L18 12L13 17" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                      </svg>
                    </span>
                  )}
                </div>
              ))}
            </div>

            <div className={styles.stepsGrid}>
              {steps.map((s, i) => (
                <div key={`card-${i}`} className={styles.stepCard}>
                  <h3 className={styles.stepTitle}>{s.title}</h3>
                  <p className={styles.stepDesc}>{s.desc}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* ── INITIATIVE ── */}
      <section className={styles.initiative}>
        <div className={styles.sectionInner}>
          <p className={styles.sectionEyebrow}>
            <span className={styles.eyebrowLine} /> Advocacy and Action
          </p>
          <div className={styles.initiativeHeader}>
            <h2 className={styles.initiativeTitle}>
              The SASHA <span className={styles.initiativeTitleAccent}>Initiative</span> 
            </h2>
            <a href="/about" className={styles.learnMoreBtn}>
              Learn More <FiArrowRight />
            </a>
          </div>
          <p className={styles.initiativeDesc}>
            SASHA conducts awareness campaigns, educational discussions, and
            organizational initiatives to promote safe spaces and uphold the
            rights of women, children, youth, and LGBTQIA+ individuals. Through
            coordinated chapters nationwide, SASHA continues to expand its reach
            and impact.
          </p>
        </div>
      </section>

      {/* ── EVENTS ── */}
      <section className={styles.events}>
        <div className={styles.sectionInner}>
          <h2 className={styles.eventsTitle}>Our Latest Events</h2>
          <div className={styles.eventsGrid}>
            {[
              { img: "/event-1.png", tag: "Gender Gap in Science", desc: "Science belongs to everyone, yet girls still face too many hurdles in STEM. We're here to clear the path and make sure the next big discovery comes from a voice that's finally being heard." },
              { img: "/event-2.png", tag: "Fight for Our Future", desc: "No one should ever feel unsafe in their own community, and we're drawing a line in the sand against harassment. We are standing together to build a culture of real protection and accountability for every scout." },
              { img: "/event-3.png", tag: "Invest for Girls, Invest for Future", desc: "When we back girls, the whole world wins. By investing in their safety and growth today, we're not just helping individuals — we're building a future led by strong, empowered women." },
            ].map((ev, i) => (
              <div key={i} className={styles.eventCard}>
                <div className={styles.eventImgWrap}>
                  <img src={ev.img} alt={ev.tag} />
                </div>
                <div className={styles.eventBody}>
                  <h3 className={styles.eventTag}>{ev.tag}</h3>
                  <p className={styles.eventDesc}>{ev.desc}</p>
                </div>
              </div>
            ))}
          </div>
          <div className={styles.eventsFooter}>
            <a href="/events" className={styles.btnPrimary}>View All Events</a>
          </div>
        </div>
      </section>

    </div>
  );
}

frontend/src/app/page.module.css
/* ── Page wrapper ── */
.pageWrapper {
  min-height: 100vh;
  background: var(--sasha-white);
  color: var(--sasha-text);
}

/* ══════════════════════════════
   SHARED SECTION UTILITIES
══════════════════════════════ */
.sectionInner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.sectionEyebrow {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 0.9rem;
  font-weight: 700;
  color: var(--sasha-muted);
  margin-bottom: 0.5rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.eyebrowLine {
  display: inline-block;
  width: 32px;
  height: 3px;
  background: var(--sasha-orange);
  border-radius: 2px;
  flex-shrink: 0;
}

.sectionEyebrowLight {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 0.9rem;
  font-weight: 700;
  color: rgba(255, 255, 255, 0.75);
  margin-bottom: 0.5rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.eyebrowLineLight {
  display: inline-block;
  width: 32px;
  height: 3px;
  background: var(--sasha-orange);
  border-radius: 2px;
  flex-shrink: 0;
}

.sectionTitle {
  font-size: 2.5rem;
  font-weight: 800;
  color: var(--sasha-teal);
}

.sectionTitleLight {
  font-size: 2.5rem;
  font-weight: 800;
  color: var(--sasha-white);
}

/* ── Shared buttons ── */
.btnPrimary {
  display: inline-block;
  background: var(--sasha-orange);
  color: var(--sasha-white);
  text-decoration: none;
  font-weight: 800;
  font-size: 0.95rem;
  padding: 0.75rem 1.75rem;
  border-radius: 999px;
  transition: background 0.2s, transform 0.1s;
}

.btnPrimary:hover {
  background: var(--sasha-orange-dark);
  transform: translateY(-1px);
}

.btnOutline {
  display: inline-block;
  background: transparent;
  color: var(--sasha-teal);
  text-decoration: none;
  font-weight: 800;
  font-size: 0.95rem;
  padding: 0.75rem 1.75rem;
  border-radius: 999px;
  border: 2.5px solid var(--sasha-teal);
  transition: background 0.2s, color 0.2s, border-color 0.2s;
}

.btnOutline:hover {
  background: var(--sasha-teal);
  color: var(--sasha-white);
}

.learnMoreBtn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--sasha-orange);
  color: var(--sasha-white);
  text-decoration: none;
  font-weight: 700;
  font-size: 0.9rem;
  padding: 0.6rem 1.4rem;
  border-radius: 999px;
  white-space: nowrap;
  transition: background 0.2s;
}

.learnMoreBtn:hover {
  background: var(--sasha-orange-dark);
}

.learnMoreBtnLight {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--sasha-orange);
  color: var(--sasha-white);
  text-decoration: none;
  font-weight: 700;
  font-size: 0.9rem;
  padding: 0.6rem 1.4rem;
  border-radius: 999px;
  white-space: nowrap;
  align-self: flex-start;
  transition: background 0.2s;
}

.learnMoreBtnLight:hover {
  background: var(--sasha-orange-dark);
}

/* ══════════════════════════════
   HERO
══════════════════════════════ */
.hero {
  position: relative;
  overflow: hidden;
  min-height: 100svh;
  display: flex;
  align-items: center;
}

/* Background layer */
.heroBg {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.heroBg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center top;
}

.heroInner {
  position: relative;
  z-index: 1;
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 6rem 2rem 5rem;

  display: flex;
  align-items: center;
  gap: 3rem;
}

/* Text column */
.heroContent {
  flex: 1 1 0;
  min-width: 0;
}

.heroEyebrow {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--sasha-muted);
  margin-bottom: 1rem;
  text-transform: uppercase;
  letter-spacing: 0.06em;
}

.heroLine {
  display: inline-block;
  width: 28px;
  height: 3px;
  background: var(--sasha-orange);
  border-radius: 2px;
  flex-shrink: 0;
}

/* clamp(min, preferred, max) — scales smoothly with viewport width */
.heroTitle {
  font-size: clamp(2rem, 5vw, 3.4rem);
  font-weight: 800;
  color: var(--sasha-teal);
  line-height: 1.15;
  margin-bottom: 1.25rem;
}

.heroTitleAccent {
  color: var(--sasha-orange);
}

.heroDesc {
  font-size: clamp(0.88rem, 1.5vw, 1rem);
  color: var(--sasha-muted);
  line-height: 1.75;
  margin-bottom: 2rem;
  max-width: 520px;
}

.heroBtns {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

/* Image column */
.heroImage {
  flex: 0 0 auto;
  width: clamp(220px, 30vw, 340px); /* fluid between 220–340px */
}

.heroImage img {
  width: 100%;
  border-radius: 16px;
  object-fit: cover;
}

/* ══════════════════════════════
   COMMITMENT
══════════════════════════════ */
.commitment {
  background: var(--sasha-offwhite);
  padding: 5rem 0;
}

.commitmentHeader {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1.25rem;
  gap: 1rem;
  flex-wrap: wrap;
}

.commitmentDesc {
  font-size: 1rem;
  color: var(--sasha-muted);
  line-height: 1.7;
  max-width: 600px;
  margin-bottom: 2.5rem;
}

.commitmentGrid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  align-items: stretch;
}

.commitmentImgWrap {
  border-radius: 16px;
  overflow: hidden;
  width: 100%;
}

.commitmentImgWrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.commitmentCard {
  background: var(--sasha-teal);
  color: var(--sasha-white);
  border-radius: 16px;
  padding: 2rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 1.5rem;
  font-size: 1rem;
  line-height: 1.7;
}

.commitmentCard strong {
  font-weight: 800;
}

.commitmentCardIcon {
  align-self: flex-end;
  background: rgba(255, 255, 255, 0.15);
  border-radius: 50%;
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--sasha-white);
}

/* ══════════════════════════════
   HOW IT WORKS
══════════════════════════════ */
.howItWorks {
  position: relative;
  padding: 5rem 0;
  overflow: hidden;
  min-height: 100svh;
}

.howBg {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.howBg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.howBgOverlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(#037F81CC, #037F81EE);
}

.howItWorks .sectionInner {
  position: relative;
  z-index: 1;
  width: 100%;
}

.howHeader {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  margin-bottom: 3rem;
  gap: 1rem;
  flex-wrap: wrap;
}

.howTitleAccent {
  color: var(--sasha-orange);
}

.timelineRow {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  position: relative;
  margin-bottom: 30px;
}

.timelineLine {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background: rgba(255, 255, 255, 0.4);
  z-index: 0;
}

.badgeWrapper {
  position: relative;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  z-index: 1;
}

.stepBadge,
.stepBadgeActive {
  background: white;
  color: #037F81;
  padding: 6px 20px;
  border-radius: 20px;
  font-weight: 700;
  font-size: 0.9rem;
}

.stepBadgeActive {
  background: #FF8A65;
  color: white;
}

.stepArrow {
  position: absolute;
  top: -1rem;
  right: -7rem;
  opacity: 0.7;
  width: 100%;
  height: 100%;
  color: var(--sasha-white);
}

.stepArrow svg {
  width: 100%;
  height: 100%;
  display: block;
}

.stepsGrid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

.stepCard {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 15px;
  padding: 30px 20px;
  min-height: 200px;
}

.stepTitle {
  color: var(--sasha-white);
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 15px;
  line-height: 1.2;
}

.stepDesc {
  color: var(--sasha-white);
  font-size: 0.95rem;
  opacity: 0.9;
  line-height: 1.6;
}

/* ══════════════════════════════
   INITIATIVE
══════════════════════════════ */
.initiative {
  padding: 5rem 0;
  background: var(--sasha-white);
}

.initiativeHeader {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1.25rem;
  gap: 1rem;
  flex-wrap: wrap;
}

.initiativeTitle {
  font-size: 2.5rem;
  font-weight: 800;
  color: var(--sasha-teal);
}

.initiativeTitleAccent {
  color: var(--sasha-orange);
}

.initiativeDesc {
  font-size: 1rem;
  color: var(--sasha-muted);
  line-height: 1.75;
  max-width: 700px;
}

/* ══════════════════════════════
   EVENTS
══════════════════════════════ */
.events {
  padding: 5rem 0;
  background: var(--sasha-offwhite);
}

.eventsTitle {
  font-size: 2rem;
  font-weight: 800;
  color: var(--sasha-teal);
  text-align: center;
  margin-bottom: 2.5rem;
  position: relative;
}

.eventsTitle::before,
.eventsTitle::after {
  content: '';
  display: inline-block;
  width: 60px;
  height: 3px;
  background: var(--sasha-orange);
  vertical-align: middle;
  margin: 0 1rem;
  border-radius: 2px;
}

.eventsGrid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.eventCard {
  background: var(--sasha-white);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
  transition: transform 0.2s, box-shadow 0.2s;
}

.eventCard:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.eventImgWrap {
  height: 180px;
  overflow: hidden;
}

.eventImgWrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.eventBody {
  padding: 1.25rem;
}

.eventTag {
  font-size: 1rem;
  font-weight: 800;
  color: var(--sasha-teal);
  margin-bottom: 0.6rem;
}

.eventDesc {
  font-size: 0.875rem;
  color: var(--sasha-muted);
  line-height: 1.65;
}

.eventsFooter {
  text-align: center;
}

/* ══════════════════════════════
   RESPONSIVE BREAKPOINTS
══════════════════════════════ */

/* ── Tablet: 768px – 1024px ── */
@media (max-width: 1024px) {
  .commitmentGrid {
    grid-template-columns: 1fr;
  }

  .stepsGrid {
    grid-template-columns: repeat(2, 1fr);
  }

  .timelineRow {
    display: none;
  }

  .howHeader {
    flex-direction: column;
    align-items: flex-start;
    gap: 1.25rem;
  }

  .footerInner {
    grid-template-columns: 1fr 1fr;
  }

  .footerBrand {
    grid-column: 1 / -1;
  }
}

/* ── Mobile: ≤ 768px ── */
@media (max-width: 768px) {

  /* HERO — single column, text first then image */
  .heroInner {
    flex-direction: column;
    align-items: flex-start; /* left-align on mobile */
    padding: 4rem 1.5rem 3.5rem;
    gap: 2rem;
  }

  .heroContent {
    width: 100%;
  }

  .heroEyebrow {
    font-size: 0.75rem;
  }

  /* clamp already handles font scaling — these are safety floors */
  .heroTitle {
    font-size: clamp(1.7rem, 7vw, 2.2rem);
    margin-bottom: 1rem;
  }

  .heroDesc {
    font-size: 0.9rem;
    max-width: 100%;
  }

  .heroBtns {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.75rem;
  }

  .heroBtns a {
    width: 100%;
    text-align: center;
  }

  /* Image: full width, capped height so it doesn't dominate */
  .heroImage {
    width: 100%;
    max-width: 320px;
    /* Center the card on mobile */
    align-self: center;
  }

  /* The overlay needs to be stronger on mobile since
     the image covers more of the viewport */
  .heroBgOverlay {
    background: linear-gradient(
      160deg,
      rgba(255, 255, 255, 0.90) 0%,
      rgba(255, 255, 255, 0.75) 60%,
      rgba(255, 255, 255, 0.45) 100%
    );
  }

  /* Other sections */
  .commitmentHeader,
  .initiativeHeader {
    flex-direction: column;
    align-items: flex-start;
  }

  .eventsGrid {
    grid-template-columns: 1fr;
  }

  .eventsTitle::before,
  .eventsTitle::after {
    display: none;
  }

  .stepsGrid {
    grid-template-columns: 1fr;
  }

  .footerInner {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .footerBrand {
    grid-column: auto;
  }

  .sectionTitle,
  .sectionTitleLight,
  .initiativeTitle {
    font-size: 1.9rem;
  }
}

/* ── Small phones: ≤ 480px ── */
@media (max-width: 480px) {
  .heroInner {
    padding: 3.5rem 1.25rem 3rem;
  }

  .heroTitle {
    font-size: clamp(1.55rem, 8vw, 1.9rem);
  }

  .sectionTitle,
  .sectionTitleLight,
  .initiativeTitle {
    font-size: 1.65rem;
  }

  .stepsGrid {
    grid-template-columns: 1fr;
  }
}

/* ── Wide screens ── */
@media (min-width: 1400px) {
  .heroInner {
    max-width: 1300px;
    padding: 7rem 2rem 6rem;
  }

  .heroImage {
    width: 380px;
  }
}

frontend/src/app/layout.js
// frontend/src/app/layout.js
//
// This is the root layout — wraps every page.
// Navbar and Footer live here so you only maintain them in one place.
//
// HOW AUTH WORKS:
//   Replace `getCurrentUser()` with your actual Supabase session call.
//   Once you have a real auth system, swap the mock below.

import 'bootstrap/dist/css/bootstrap.min.css';
import './globals.css';
import Navbar from '@/components/navbar/navbar';
import Footer from '@/components/footer/footer';

export const metadata = {
  title: 'Savira',
  description: 'Savira Web App',
};

// ── Mock: replace this with your real Supabase session fetch ────────────────
// Example with Supabase (server component):
//
//   import { createServerComponentClient } from '@supabase/auth-helpers-nextjs'
//   import { cookies } from 'next/headers'
//
//   async function getCurrentUser() {
//     const supabase = createServerComponentClient({ cookies })
//     const { data: { session } } = await supabase.auth.getSession()
//     if (!session) return null
//     // fetch role from your users table
//     const { data } = await supabase
//       .from('users')
//       .select('role, first_name, last_name')
//       .eq('id', session.user.id)
//       .single()
//     return data
//   }
//
// For now, returning null = logged out (public visitor):
async function getCurrentUser() {
  return null;

  // To test a logged-in reporter, uncomment:
  return { role: "complainant", firstName: "Maria", lastName: "Santos" };

  // To test a case officer:
  // return { role: "case_officer", firstName: "Juan", lastName: "Cruz" };

  // To test an admin:
  // return { role: "admin", firstName: "Ana", lastName: "Reyes" };
}
// ────────────────────────────────────────────────────────────────────────────

export default async function RootLayout({ children }) {
  const user = await getCurrentUser();

  return (
    <html lang="en">
      <body>
        <Navbar user={user} />
        <main>{children}</main>
        <Footer user={user} />
      </body>
    </html>
  );
  
  // For testing, you can hardcode a user object here instead of calling getCurrentUser():
  // const adminUser = {
  //   role: "admin",
  //   firstName: "Admin",
  //   lastName: "User"
  // };
  // return (
  //   <html lang="en">
  //     <body>
  //       <Navbar user={adminUser} />
  //     <main>{children}</main>
  //     <Footer user={adminUser} />
  //     </body>
  //   </html>
  // );
  // const complainantUser = {
  //   role: "complainant",
  //   firstName: "Maria",
  //   lastName: "Santos"
  // };
  // return (
  //   <html lang="en">
  //     <body>
  //       <Navbar user={complainantUser} />
  //     <main>{children}</main>
  //     <Footer user={complainantUser} />
  //     </body>
  //   </html>
  // );
}

frontend/src/components/navbar/navbar.js
"use client";

import { useState } from "react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import { FiMenu, FiX } from "react-icons/fi";
import styles from "./navbar.module.css";

/**
 * Navbar Component
 *
 * Props:
 *   user  — null (logged out) | { role: "complainant" | "case_officer" | "admin" | "legal" | "sasha_officer" }
 *
 * Usage:
 *   <Navbar user={null} />               ← public visitor
 *   <Navbar user={{ role: "complainant" }} /> ← logged-in complainant
 */

// ── Link definitions per role ────────────────────────────────────────────────

const PUBLIC_LINKS = [
  { href: "/",         label: "Home" },
  { href: "/about",   label: "About" },
  { href: "/events",  label: "Events" },
  { href: "/contact", label: "Contact" },
  { href: "/volunteer", label: "Volunteer" },
];

const COMPLAINANT_LINKS = [
  { href: "/dashboard",      label: "Home" },
  { href: "/about",   label: "About" },
  { href: "/report",     label: "Report" },
  { href: "/volunteer", label: "Volunteer" },
  { href: "/contact", label: "Contact" },
  { href: "/events",         label: "Events" },
];

const CASE_OFFICER_LINKS = [
  { href: "/dashboard", label: "Home" },
  { href: "/case-officer/cases",     label: "Cases" },
  { href: "/case-officer/projects",  label: "Projects" },
  { href: "/case-officer/insights", label: "Insights" },
];

const STAFF_LINKS = [
  { href: "/dashboard",     label: "Home" },
  { href: "/applications",  label: "Applications" },
  { href: "/projects",      label: "Projects" },
  { href: "/heatmap",       label: "Heatmap" },
  { href: "/reports",       label: "Reports" },
];

const LEGAL_LINKS = [
  { href: "/dashboard",     label: "Home" },
  { href: "/legalReviews",  label: "Legal Review" },
  { href: "/cases",         label: "Cases" },
  { href: "/heatmap",       label: "Heatmap" },
  { href: "/reports",       label: "Reports" },
];

const ADMIN_LINKS = [
  { href: "/dashboard", label: "Home" },
  { href: "/users",     label: "Users" },
  { href: "/cases",     label: "Cases" },
  { href: "/legalReviews",     label: "Legal Review" },
  { href: "/projects",     label: "Projects" },
  { href: "/volunteer", label: "Volunteers" },
  { href: "/heatmap", label: "Heatmap" },
  { href: "/reports",   label: "Reports" },
];

function getLinks(user) {
  if (!user) return PUBLIC_LINKS;
  switch (user.role?.toLowerCase()) {
    case "complainant":   return COMPLAINANT_LINKS;
    case "case_officer":  return CASE_OFFICER_LINKS;
    case "admin":         return ADMIN_LINKS;
    case "legal":         return LEGAL_LINKS;
    case "sasha_officer": return SASHA_OFFICER_LINKS;
    default:              return PUBLIC_LINKS;
  }
}

// ── Component ────────────────────────────────────────────────────────────────

export default function Navbar({ user = null }) {
  const [menuOpen, setMenuOpen] = useState(false);
  const pathname = usePathname();
  const links = getLinks(user);

  const isActive = (href) => {
    if (href === "/") return pathname === "/";
    return pathname.startsWith(href);
  };

  const closeMenu = () => setMenuOpen(false);

  return (
    <nav className={styles.navbar}>
      <div className={styles.navInner}>

        {/* ── Burger (mobile left) ── */}
        <button
          className={styles.burgerBtn}
          onClick={() => setMenuOpen(!menuOpen)}
          aria-label="Toggle menu"
          aria-expanded={menuOpen}
        >
          {menuOpen ? <FiX size={22} /> : <FiMenu size={22} />}
        </button>

        {/* ── Logo (center on mobile, left on desktop) ── */}
        <Link href="/" className={styles.navLogo} onClick={closeMenu}>
          <img src="/sasha-logo-white.png" alt="SASHA logo" />
        </Link>

        {/* ── Desktop links ── */}
        <ul className={styles.navLinks}>
          {links.map(({ href, label }) => (
            <li key={href}>
              <Link
                href={href}
                className={isActive(href) ? styles.navLinkActive : styles.navLink}
              >
                {label}
              </Link>
            </li>
          ))}
        </ul>

        {/* ── Right action (login / user menu) ── */}
        <div className={styles.navRight}>
          {user ? (
            <UserMenu user={user} />
          ) : (
            <Link href="/login" className={styles.navLoginBtn}>
              Log In
            </Link>
          )}
        </div>

      </div>

      {/* ── Mobile dropdown ── */}
      {menuOpen && (
        <div className={styles.mobileMenu}>
          <ul className={styles.mobileLinks}>
            {links.map(({ href, label }) => (
              <li key={href}>
                <Link
                  href={href}
                  className={isActive(href) ? styles.mobileLinkActive : styles.mobileLink}
                  onClick={closeMenu}
                >
                  {label}
                </Link>
              </li>
            ))}
          </ul>

          <div className={styles.mobileDivider} />

          {user ? (
            <div className={styles.mobileUserSection}>
              <span className={styles.mobileUserName}>
                {user.firstName ?? "Account"}
              </span>
              {/* Replace href with your actual logout handler */}
              <Link href="/logout" className={styles.mobileLogoutBtn} onClick={closeMenu}>
                Log Out
              </Link>
            </div>
          ) : (
            <Link href="/login" className={styles.mobileLoginBtn} onClick={closeMenu}>
              Log In
            </Link>
          )}
        </div>
      )}
    </nav>
  );
}

// ── User avatar / dropdown (desktop) ────────────────────────────────────────

function UserMenu({ user }) {
  const [open, setOpen] = useState(false);

  const ROLE_LABEL = {
    complainant:     "Complainant",
    case_officer: "Case Officer",
    admin:        "Admin",
  };

  return (
    <div className={styles.userMenu}>
      <button
        className={styles.userAvatar}
        onClick={() => setOpen(!open)}
        aria-label="Account menu"
        aria-expanded={open}
      >
        {/* Initials fallback */}
        <span>{user.firstName?.[0] ?? "U"}{user.lastName?.[0] ?? ""}</span>
      </button>

      {open && (
        <div className={styles.userDropdown}>
          <p className={styles.dropdownName}>
            {user.firstName} {user.lastName}
          </p>
          <p className={styles.dropdownRole}>{ROLE_LABEL[user.role]}</p>
          <hr className={styles.dropdownDivider} />
          <Link href="/profile"  className={styles.dropdownItem} onClick={() => setOpen(false)}>My Profile</Link>
          <Link href="/settings" className={styles.dropdownItem} onClick={() => setOpen(false)}>Settings</Link>
          <hr className={styles.dropdownDivider} />
          {/* Replace href with your actual logout handler */}
          <Link href="/logout" className={`${styles.dropdownItem} ${styles.dropdownLogout}`} onClick={() => setOpen(false)}>
            Log Out
          </Link>
        </div>
      )}
    </div>
  );
}