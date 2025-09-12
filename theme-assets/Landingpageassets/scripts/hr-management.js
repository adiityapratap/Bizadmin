document.addEventListener("DOMContentLoaded", function () {
  const features = [
    {
      id: "onboarding",

      title: "Onboarding",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr/features.jpg",
      description:
        "Streamline the onboarding process by automating paperwork, training schedules, and necessary documentation, ensuring a smooth transition for new employees.",
      benefits: [
        "Simplify New Hires: Streamline the onboarding process by automating paperwork, training schedules, and necessary documentation.",
        "Centralized Documentation: Keep all onboarding materials in one place for easy access and management.",
      ],
    },
    {
      id: "leave",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr/features.jpg",
      title: "Leave",
      description:
        "Manage employee leave requests with ease. Track leave balances, approve requests, and maintain accurate records.",
      benefits: [
        "Track and Approve Leave: Manage employee leave requests with ease. Track leave balances, approve requests, and maintain accurate records.",
        "Leave Taken Insights: Provide employees with visibility into their leave usage history.",
      ],
    },
    {
      id: "payroll",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr/features.jpg",
      title: "Payroll",
      description:
        "Seamlessly integrate payroll with your accounting software for streamlined financial management and reporting.",
      benefits: [
        "Payroll Integration: Seamlessly integrate payroll with your accounting software for streamlined financial management and reporting.",
        "Comprehensive Reporting: Generate detailed payroll reports for better financial oversight and compliance.",
      ],
    },
    {
      id: "roster",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr/features.jpg",
      title: "Roster",
      description:
        "Automatically generate rosters based on employee availability and business needs, reducing scheduling conflicts and ensuring optimal staffing levels.",
      benefits: [
        "Auto-Create Rosters: Automatically generate rosters based on employee availability and business needs.",
        "Task Recording: Keep detailed records of tasks assigned to each employee, ensuring accountability and clarity.",
        "Effective Scheduling: Plan and manage employee work hours to optimize productivity and meet operational requirements.",
      ],
    },
    {
      id: "timesheet",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr/features.jpg",
      title: "Timesheet",
      description:
        "Enable employees to clock in and out effortlessly, ensuring accurate time tracking and streamlined approval processes.",
      benefits: [
        "Seamless Clock In/Clock Out: Enable employees to clock in and out effortlessly, ensuring accurate time tracking.",
        "Automatic Timesheet Approvals: Streamline the approval process with automatic approval features, reducing administrative workload.",
        "Timesheet Rounding: Ensure consistency and fairness with automatic rounding of timesheet entries.",
      ],
    },
    {
      id: "memo",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr/features.jpg",
      title: "Memo",
      description:
        "Efficiently communicate with staff by managing memos and announcements through Bizadmin. Keep your team informed and engaged.",
      benefits: [
        "Effective Communication: Efficiently communicate with staff by managing memos and announcements through Bizadmin.",
        "Team Engagement: Keep your team informed and engaged with timely and relevant communications.",
      ],
    },
    {
      id: "learning",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr/features.jpg",
      title: "Learning",
      description:
        "Store and manage all HR documents in one secure, centralized location for easy access and organization.",
      benefits: [
        "Centralized Storage: Store and manage all HR documents in one secure, centralized location for easy access and organization.",
        "Efficient Retrieval: Quickly retrieve important documents when needed, ensuring compliance and facilitating audits.",
        "Secure and Compliant: Ensure all documents are stored securely, maintaining compliance with data protection regulations.",
        "Employee Development: Facilitate employee development with Bizadmin's learning management features.",
      ],
    },
    {
      id: "compliance",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr/features.jpg",
      title: "Compliance",
      description:
        "Maintain records of workplace injuries and ensure compliance with health and safety regulations.",
      benefits: [
        "Injury Reports: Maintain records of workplace injuries and ensure compliance with health and safety regulations.",
        "Incident Reports: Document and manage incidents effectively to address issues promptly.",
        "Reimbursement: Handle employee reimbursements efficiently, ensuring timely and accurate processing.",
        "Performance Evaluation: Conduct thorough performance evaluations to assess employee contributions and identify areas for improvement.",
      ],
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
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                  <polyline points="22 4 12 14.01 9 11.01"></polyline>
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
      (product) =>
        product.name.toLowerCase() === "HR & Onboarding".toLowerCase()
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
