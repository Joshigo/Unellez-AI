class Menu {
  constructor(element, options) {
    this.element = element;
    this.options = options;
    this.init();
  }

  init() {
    // Inicialización básica del menú
    console.log('Menu initialized');
  }
}

const Helpers = {
  isSmallScreen: function () {
    return window.innerWidth < 1200;
  },

  toggleCollapsed: function () {
    const menu = document.getElementById('layout-menu');
    if (menu) {
      menu.classList.toggle('menu-hidden');
      // Guardar estado en localStorage
      localStorage.setItem('menuCollapsed', menu.classList.contains('menu-hidden'));
    }
  },

  setAutoUpdate: function () {
    // Actualizar en cambio de tamaño
    window.addEventListener('resize', () => {
      if (!this.isSmallScreen()) {
        const menu = document.getElementById('layout-menu');
        if (menu) menu.classList.remove('menu-hidden');
      }
    });
  }
};

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function () {
  // Inicializar menú
  const layoutMenuEl = document.getElementById('layout-menu');
  if (layoutMenuEl) {
    new Menu(layoutMenuEl, {
      orientation: 'vertical',
      closeChildren: false
    });
  }

  // Inicializar togglers del menú
  const menuTogglers = document.querySelectorAll('.layout-menu-toggle, #toggle-menu');
  menuTogglers.forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();
      Helpers.toggleCollapsed();
    });
  });

  // Configurar auto actualización
  Helpers.setAutoUpdate();

  // Cargar estado del menú
  const menuCollapsed = localStorage.getItem('menuCollapsed') === 'true';
  const menu = document.getElementById('layout-menu');
  if (menu && menuCollapsed && Helpers.isSmallScreen()) {
    menu.classList.add('menu-hidden');
  }
});
