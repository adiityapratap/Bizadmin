document.addEventListener("DOMContentLoaded", function () {
  const features = [
    {
      id: "task-breakdown-management",
      title: "Task Management",
      description:
        "Set priorities and deadlines to ensure tasks are completed on time, keeping your workflow efficient.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/checklists/features.jpg",
      benefits: [
        "Easily assign responsibilities and track completions in real time to maintain accountability across the team.",
        "Break down large projects into manageable tasks with clear priorities and deadlines, helping teams stay organized and productive.",
        "Structure your workflow with custom checklists and schedule tasks for better planning and improved productivity.",
      ],
      content: "",
    },
    {
      id: "prioritization-deadlines",
      title: "Prioritization",
      content: "",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/checklists/features.jpg",
      benefits: [
        "Effectively prioritize your work and set achievable deadlines to ensure timely delivery and reduce last-minute stress.",
      ],
      description:
        "Set priorities and deadlines to keep your workflow on track by assigning tasks to team members and monitoring their progress. Plan ahead with scheduled daily, weekly, and monthly checklists, ensuring tasks are completed efficiently and on time.",
    },
    {
      id: "work-review-tracking",
      title: "Review & Tracking",
      content: "",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/checklists/features.jpg",
      benefits: [
        "Enable efficient oversight with screenshot attachments and progress tracking, fostering transparency and constructive feedback.",
      ],
      description:
        "Attach screenshots of completed tasks for supervisors to review and provide feedback..",
    },
    {
      id: "progress-monitoring",
      title: "Progress Monitoring",
      content: "",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/checklists/features.jpg",
      benefits: [
        "Use visual cues and indicators to monitor task status and stay informed about what’s done, in progress, or overdue.",
      ],
      description:
        "Track your progress with visual indicators, making it easier to see what’s completed and what’s pending.",
    },
    {
      id: "notifications-reminders",
      title: "Notifications",
      content: "S",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/checklists/features.jpg",
      benefits: [
        "Receive smart reminders and timely alerts to ensure you never miss a task or deadline again.",
      ],
      description:
        "tay on top of your schedule with timely notifications and reminders for upcoming tasks.",
    },
  ];

  const tabButtons = document.querySelectorAll(".ft-tab");
  const titleEl = document.querySelector(".ft-feature-title");
  const descEl = document.querySelector(".ft-feature-description");
  const benefitsList = document.querySelector(".ft-benefits-list");
  const imageEl = document.querySelector("#feature-display");

  const getFeatureByName = (name) => {
    return features.find((f) =>
      f.title.toLowerCase().includes(name.toLowerCase())
    );
  };

  tabButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      // Remove active class from all tabs
      tabButtons.forEach((tab) => tab.classList.remove("active"));
      btn.classList.add("active");

      const tabName = btn.querySelector(".ft-tab-text").innerText;
      const feature = getFeatureByName(tabName);

      if (feature) {
        // Update Title & Description
        titleEl.textContent = feature.title;
        descEl.textContent = feature.description;

        // Update Benefits
        benefitsList.innerHTML = "";
        feature.benefits.forEach((benefit) => {
          const li = document.createElement("li");
          li.classList.add("ft-benefit-item");
          li.innerHTML = `
                  <span class="ft-check-icon">
                   <svg
      xmlns="http://www.w3.org/2000/svg"
      width="20"
      height="20"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
    >
      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
      <polyline points="22 4 12 14.01 9 11.01" />
    </svg>
                  </span>
                  <span class="nunito-sans-text">${benefit}</span>
                `;
          benefitsList.appendChild(li);
        });

        // Update Image
        imageEl.setAttribute("src", feature.image);
        imageEl.setAttribute("alt", `${feature.title} Feature`);
      }
    });
  });
});

const products = [
  {
    name: "HR & Onboarding",
    onlyMobile: false,
    description:
      "Simplify new hires with automated onboarding and employee tracking.",
    image:
      "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr.png",
    link: "hr-management",
  },
  {
    name: "Suppliers",
    onlyMobile: false,
    description: "Manage suppliers, contacts, and orders all in one dashboard.",
    image:
      "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/suppliers.png",
    link: "supplier-inventory-management",
  },
  {
    name: "Ordering Portal",
    onlyMobile: false,
    description:
      "Easily order supplies and track procurement with a streamlined portal.",
    image:
      "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/ordering.png",
    link: "ordering-management",
  },
  {
    name: "Checklists",
    onlyMobile: false,
    description:
      "Ensure operational consistency with smart checklists for daily tasks.",
    image:
      "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/checklists.png",
    link: "checklists-management",
  },
  {
    name: "Cleaning Schedule",
    onlyMobile: false,
    description:
      "Maintain hygiene standards through scheduled and trackable cleaning tasks.",
    image:
      "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/cleaning.png",
    link: "cleaning-management",
  },
  {
    name: "Temperature Recording",
    onlyMobile: false,
    description:
      "Automate and log temperature data for food safety and compliance.",
    image:
      "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/temperature.png",
    link: "temperature-management",
  },
  {
    name: "Document Manage",
    onlyMobile: false,
    description:
      "Centralize and secure all your important documents in one place.",
    image:
      "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/documents.png",
    link: "documents-management",
  },
  {
    name: "Cash Management",
    onlyMobile: false,
    description:
      "Manage your café’s cash operations effortlessly with real-time tracking and reports.",
    image:
      "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/cash.png",
    link: "cash-management",
  },
];

document.addEventListener("DOMContentLoaded", () => {
  const platformsBtn = document.querySelector(".platforms-btn");
  const dropdown = document.querySelector(".dropdown");
  const productItems = document.querySelectorAll(".product-item");
  const dropdownMiddle = document.querySelector(".dropdown-middle");
  const dropdownRight = document.querySelector(".dropdown-right");

  // Toggle dropdown visibility
  platformsBtn.addEventListener("click", (e) => {
    e.stopPropagation(); // Prevent the event from propagating to the document
    dropdown.classList.toggle("open"); // toggle dropdown visibility
  });

  // Toggle the dropdown when the platforms button is clicked
  platformsBtn.addEventListener("click", (e) => {
    e.stopPropagation(); // Prevent event bubbling
    dropdown.classList.toggle("show");
  });

  // Close the dropdown if clicking outside of it or on the platforms button again
  document.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target) && !platformsBtn.contains(e.target)) {
      dropdown.classList.remove("show");
    }
  });

  const selectedProduct =
    products.find(
      (product) => product.name.toLowerCase() === "Checklists".toLowerCase()
    ) ?? products[0];

  // Handle active class and update dropdown content
  productItems.forEach((item) => {
    console.log(item.innerText);
    if (
      selectedProduct &&
      item.innerText.trim().toLowerCase() ===
        selectedProduct.name.trim().toLowerCase()
    ) {
      item.classList.add("active");

      // Update the dropdown middle and right content with the product's details
      dropdownMiddle.querySelector("h4").textContent = selectedProduct.name;
      dropdownMiddle.querySelector("p").textContent =
        selectedProduct.description;
      dropdownRight.querySelector("img").src = selectedProduct.image; // Change the image source
    } else {
      item.classList.remove("active"); // Remove active class from all items
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const modalOverlay = document.querySelector(".modal-overlay");
  const closeBtn = document.querySelector(".close-btn");
  const getStartedBtn = document.querySelector(".get-started-btn");

  // Open the modal when the "Get Started" button is clicked
  getStartedBtn.addEventListener("click", () => {
    modalOverlay.style.display = "";
  });

  // Close the modal when clicking the close button
  closeBtn.addEventListener("click", () => {
    modalOverlay.style.display = "none";
  });

  // Close the modal when clicking outside the modal box (on the overlay)
  modalOverlay.addEventListener("click", (e) => {
    if (e.target === modalOverlay) {
      modalOverlay.style.display = "none";
    }
  });
});
