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

  // Handle active class and update dropdown content
  productItems.forEach((item) => {
    item.addEventListener("click", () => {
      productItems.forEach((product) => product.classList.remove("active")); // Remove active class from all items
      item.classList.add("active"); // Add active class to clicked item

      // Find the product that matches the clicked item's text
      const productName = item.textContent.trim();
      const selectedProduct = products.find(
        (product) => product.name.toLowerCase() === productName.toLowerCase()
      );

      if (selectedProduct) {
        // Update the dropdown middle and right content with the product's details
        dropdownMiddle.querySelector("h4").textContent = selectedProduct.name;
        dropdownMiddle.querySelector("p").textContent =
          selectedProduct.description;
        dropdownRight.querySelector("img").src = selectedProduct.image;
      }
    });
  });

  const firstItem = productItems[0];
  const firstProduct = products[0];

  if (firstItem && firstProduct) {
    firstItem.classList.add("active");
    dropdownMiddle.querySelector("h4").textContent = firstProduct.name;
    dropdownMiddle.querySelector("p").textContent = firstProduct.description;
    dropdownRight.querySelector("img").src = firstProduct.image;
  }

  // Close dropdown when clicking outside of it
  document.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target) && e.target !== platformsBtn) {
      dropdown.classList.remove("open"); // Close the dropdown if clicked outside
    }
  });

  // Prevent dropdown from closing if clicked inside it
  dropdown.addEventListener("click", (e) => {
    e.stopPropagation();
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const platformsBtn = document.querySelector(".platforms-btn");
  const dropdown = document.querySelector(".platforms-dropdown");

  platformsBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    dropdown.classList.toggle("show");
  });

  document.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target) && !platformsBtn.contains(e.target)) {
      dropdown.classList.remove("show");
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const modalOverlay = document.querySelector(".modal-overlay");
  const closeBtn = document.querySelector(".close-btn");
  const getStartedBtn = document.querySelector(".get-started-btn");
  const letsTalkBtn = document.querySelector(".lets-talk-button");

  // Open the modal when the "Get Started" button is clicked
  getStartedBtn.addEventListener("click", () => {
    modalOverlay.style.display = "";
    document.body.classList.add("no-scroll");
  });

  letsTalkBtn.addEventListener("click", () => {
    modalOverlay.style.display = "";
    document.body.classList.add("no-scroll");
  });

  // Close the modal when clicking the close button
  closeBtn.addEventListener("click", () => {
    modalOverlay.style.display = "none";
    document.body.classList.remove("no-scroll");
  });

  // Close the modal when clicking outside the modal box (on the overlay)
  modalOverlay.addEventListener("click", (e) => {
    if (e.target === modalOverlay) {
      modalOverlay.style.display = "none";
      document.body.classList.remove("no-scroll");
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const slides = [
    {
      title: "Operations & Compliance Management",
      text: "Streamline daily operations with checklist tracking, temperature recording, and cleaning task automation.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/temperature-feature.jpg",
    },
    {
      title: "Inventory & Supplier Management",
      text: "Monitor stock levels, manage suppliers, and track orders efficiently.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/inventory-supplier-feature.jpg",
    },
    {
      title: "HR & Workforce Management",
      text: "Simplify employee scheduling, timesheets, and HR processes in one place.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/hr-feature.jpg",
    },
    {
      title: "Finance & Documentation Control",
      text: "Manage cash flow, organize important documents, and track financial records seamlessly.",
      image:
        "https://bizadmin.com.au/theme-assets/Landingpageassets/assets/finance-feature.jpeg",
    },
  ];

  const textItems = document.querySelectorAll(".text-item");
  const image = document.querySelector("#sliderimg");

  let currentIndex = Array.from(textItems).findIndex((item) =>
    item.classList.contains("active")
  );

  // Fallback if none has 'active' initially
  if (currentIndex === -1) currentIndex = 0;

  function updateActiveItems(index) {
    textItems.forEach((item, i) => {
      item.classList.toggle("active", i === index);
    });

    image.setAttribute("src", slides[index].image);
    image.setAttribute("alt", `${slides[index].title} Feature`);
  }

  function nextItem() {
    currentIndex = (currentIndex + 1) % textItems.length;
    updateActiveItems(currentIndex);
  }

  // Initial setup
  updateActiveItems(currentIndex);

  // Change every 3 seconds
  setInterval(nextItem, 3000);
});
