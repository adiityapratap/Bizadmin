document.addEventListener("DOMContentLoaded", function () {
  const features = [
    {
      id: "Supplier Order Management",
      title: "Supplier Order",
      content:
        "Place orders directly through Bizadmin, eliminating manual processes and ensuring seamless communication with suppliers.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/suppliers/feature.jpg",
      benefits: [
        "Eliminate manual processes by placing orders directly through Bizadmin, making the procurement process more efficient.",
        "Ensure seamless communication with suppliers, streamlining the order process and reducing the chance of errors or delays.",
      ],
      description:
        "Simplify your procurement process with seamless supplier order management.",
    },
    {
      id: "Manual Stock Takes",
      title: "Stock Takes",
      content:
        "Conduct daily and monthly stock takes manually using Bizadmin’s intuitive tools. Maintain accurate inventory records without the need for complex systems.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/suppliers/feature.jpg",
      benefits: [
        "Conduct daily and monthly stock takes manually, ensuring accurate inventory records without relying on complex systems.",
        "Utilize Bizadmin’s intuitive tools to make stock taking easy and efficient, reducing errors and manual tracking time.",
      ],
      description:
        "Easily track inventory and perform stock takes with Bizadmin's intuitive tools.",
    },
    {
      id: "Budget Management",
      title: "Budget Management",
      content:
        "Manage budgets and streamline order approvals within the centralized Bizadmin platform. Maintain financial discipline while optimizing procurement.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/suppliers/feature.jpg",
      benefits: [
        "Streamline budget management and order approvals, providing a clear overview of finances to ensure control over spending.",
        "Optimize procurement within the Bizadmin platform, maintaining financial discipline while improving operational efficiency.",
      ],
      description:
        "Efficiently manage budgets and approvals for smooth procurement operations.",
    },
    {
      id: "Delivery Management",
      title: "Delivery Management",
      content:
        "Track supplier deliveries effortlessly. Receive real-time notifications and monitor delivery progress to ensure timely receipt of orders. Access comprehensive delivery details including expected times and logistical information directly through Bizadmin. Plan and coordinate receiving operations seamlessly.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/suppliers/feature.jpg",
      benefits: [
        "Monitor delivery progress easily, ensuring that all orders are tracked from start to finish.",
        "Receive real-time notifications when deliveries occur, enabling you to take immediate action if there are any delays or issues.",
        "Access detailed delivery information such as expected delivery times and logistical data, which helps you plan ahead.",
        "Coordinate receiving operations efficiently by having all necessary delivery information directly available in Bizadmin.",
      ],
      description:
        "Keep track of deliveries and ensure orders are received on time with ease.",
    },
    {
      id: "Supplier Notifications",
      title: "Notifications",
      content:
        "Stay informed with notifications when suppliers receive and acknowledge your orders. Foster transparent communication throughout the supply chain.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/suppliers/feature.jpg",
      benefits: [
        "Receive notifications when suppliers acknowledge and receive your orders, ensuring you're always informed about order status.",
        "Foster transparent communication between you and your suppliers, improving supply chain visibility and collaboration.",
      ],
      description:
        "Enhance communication with suppliers and ensure transparency throughout the supply chain.",
    },
    {
      id: "Purchase Reports and Analytics",
      title: "Reports and Analytics",
      content:
        "Generate detailed reports and analytics on purchases made through Bizadmin. Gain insights to improve procurement strategies and control costs effectively.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/suppliers/feature.jpg",
      benefits: [
        "Generate insightful reports and analytics that offer valuable data on your procurement practices, helping you make better decisions.",
        "Gain a deeper understanding of purchasing trends and costs, which helps you optimize procurement strategies and reduce overspending.",
      ],
      description:
        "Gain valuable insights into your procurement strategies through detailed reports and analytics.",
    },
    {
      id: "Minimum Order Requirements",
      title: "Order Requirements",
      content:
        "Easily manage suppliers' minimum order requirements to optimize purchasing decisions and maintain efficient inventory levels.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/suppliers/feature.jpg",
      benefits: [
        "Manage suppliers' minimum order requirements with ease, ensuring that you only purchase what is necessary to maintain efficient inventory levels.",
        "Optimize purchasing decisions by adhering to suppliers' order requirements, avoiding excess stock or shortfalls.",
      ],
      description:
        "Ensure efficient inventory levels by managing minimum order requirements effortlessly.",
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
      (product) => product.name.toLowerCase() === "Suppliers".toLowerCase()
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
