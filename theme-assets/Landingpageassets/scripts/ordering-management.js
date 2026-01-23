document.addEventListener("DOMContentLoaded", function () {
  const features = [
    {
      title: "Customer Management",
      description:
        "Streamline customer interactions and maintain strong relationships effortlessly. Generate professional quotes quickly and efficiently for your customers.",
      benefits: [
        "Streamline customer data management by storing all information in a single, organized database for quick retrieval and efficient service.",
        "Enhance customer relationships with comprehensive profiles that help personalize interactions and improve customer service experiences.",
        "Speed up your sales process with instant, precise quotes that help customers make informed decisions while reducing manual errors.",
      ],
      id: "customer-management-id",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/ordering-portal/features.jpg",
    },
    {
      title: "Invoices",
      description:
        "Easily create and send invoices to ensure smooth payment processing.",
      benefits: [
        "Simplify your billing process by converting quotes into professional invoices instantly, reducing manual work and errors.",
        "Enhance efficiency by automating invoice delivery, ensuring customers receive accurate billing information without delays.",
      ],
      id: "create-send-invoices-id",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/ordering-portal/features.jpg",
    },
    {
      title: "Payment",
      description:
        "Generate and share secure payment links for hassle-free transactions. Automate payment reminders to ensure timely collections and reduce delays.",
      benefits: [
        "Enhance customer convenience by providing secure payment options directly within invoices, ensuring a seamless transaction experience.",
        "Speed up cash flow with quick and easy online payment solutions, minimizing delays and improving financial efficiency.",
        "Reduce late payments by automating reminders, ensuring customers are notified about due invoices on time.",
        "Maintain a healthy cash flow by minimizing overdue payments through timely and automated invoice follow-ups.",
      ],
      id: "send-payment-links-id",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/ordering-portal/features.jpg",
    },

    {
      title: "Feedback",
      description:
        "Engage customers with feedback emails to improve services and satisfaction.",
      benefits: [
        "Gain valuable insights from customers by automating feedback collection, helping you understand their experiences and expectations.",
        "Leverage customer feedback to refine your services, resolve concerns swiftly, and enhance overall satisfaction.",
      ],
      id: "send-feedback-mail-id",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/ordering-portal/features.jpg",
    },
    {
      title: "Dashboard & Reports",
      description:
        "Monitor and manage deliveries in real-time with a centralized dashboard.  Generate insightful reports to analyze performance and drive better decisions.",
      benefits: [
        "Monitor and track all your upcoming deliveries in one place, ensuring timely dispatch and seamless coordination.",
        "Enhance your delivery operations by optimizing schedules and reducing delays with a clear, structured planning system.",
        "Stay ahead with detailed reports that provide a clear overview of your business activities, helping you optimize performance and efficiency.",
        "Leverage accurate data to enhance decision-making, streamline processes, and drive business growth.",
      ],
      id: "dashboard-for-deliveries-id",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/ordering-portal/features.jpg",
    },
    {
      title: "Track Orders",
      description:
        "Stay updated on delivery status with real-time tracking and notifications. Easily access and review past orders to improve service and inventory planning.",
      benefits: [
        "Gain full visibility into your delivery process with real-time tracking, ensuring efficiency and on-time arrivals.",
        "Enhance customer experience by providing timely notifications and tracking details for their deliveries.",
        "Easily monitor past transactions, ensuring clear visibility into paid and pending orders for better financial oversight.",
        "Maintain a healthy cash flow by efficiently tracking outstanding invoices and taking prompt action when necessary.",
      ],
      id: "track-deliveries-id",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/ordering-portal/features.jpg",
    },
    {
      title: "Production Sheets",
      description:
        "Create detailed production sheets to streamline staff workflow and efficiency.",
      benefits: [
        "Keep your workflow structured with easy access to production sheets, ensuring accurate and timely order preparation.",
        "Boost productivity with well-organized production schedules, reducing errors and optimizing resources.",
      ],
      id: "generate-production-sheets-for-staff-id",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/ordering-portal/features.jpg",
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
      (product) =>
        product.name.toLowerCase() === "Ordering Portal".toLowerCase()
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
