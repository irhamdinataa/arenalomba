// Organizational Chart JavaScript functionality
class OrganizationalChart {
    constructor() {
        this.employees = this.getEmployeeData();
        this.init();
    }

    init() {
        this.addAnimationDelays();
        this.addInteractivity();
        this.addResponsiveHandling();
        this.addSearchFunctionality();
    }

    // Employee data
    getEmployeeData() {
        return [
            {
                id: 1,
                name: 'Puthut EA',
                title: 'DIREKTUR KHUSUS PRIMA',
                department: 'Leadership',
                photo: 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'puthut.ea@majasarijaya.co.id',
                phone: '+62 812-3456-7890',
                experience: '8 years',
                projects: 45
            },
            {
                id: 2,
                name: 'Agung Purwandono',
                title: 'PEMIMPIN SETIJAB / PENANGGUNG JAWAB',
                department: 'Leadership',
                photo: 'https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'agung.purwandono@majasarijaya.co.id',
                phone: '+62 813-3456-7891',
                experience: '6 years',
                projects: 38
            },
            {
                id: 3,
                name: 'M. Aly Reza',
                title: 'KOORDINATOR',
                department: 'Liputan',
                photo: 'https://images.pexels.com/photos/1310522/pexels-photo-1310522.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'm.aly.reza@majasarijaya.co.id',
                phone: '+62 814-3456-7892',
                experience: '5 years',
                projects: 32
            },
            {
                id: 4,
                name: 'Ahmad Umndi',
                title: 'REPORTER',
                department: 'Liputan',
                photo: 'https://images.pexels.com/photos/2586831/pexels-photo-2586831.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'ahmad.umndi@majasarijaya.co.id',
                phone: '+62 815-3456-7893',
                experience: '3 years',
                projects: 28
            },
            {
                id: 5,
                name: 'Asyiah Aurita',
                title: 'REPORTER',
                department: 'Liputan',
                photo: 'https://images.pexels.com/photos/1181519/pexels-photo-1181519.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'asyiah.aurita@majasarijaya.co.id',
                phone: '+62 816-3456-7894',
                experience: '4 years',
                projects: 25
            },
            {
                id: 6,
                name: 'Purius Soro Witomo',
                title: 'KAMERAMAN',
                department: 'Terminal',
                photo: 'https://images.pexels.com/photos/2182957/pexels-photo-2182957.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'purius.soro.witomo@majasarijaya.co.id',
                phone: '+62 817-3456-7895',
                experience: '5 years',
                projects: 42
            },
            {
                id: 7,
                name: 'Rizky Prasarya',
                title: 'EDITOR',
                department: 'Terminal',
                photo: 'https://images.pexels.com/photos/1024311/pexels-photo-1024311.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'rizky.prasarya@majasarijaya.co.id',
                phone: '+62 818-3456-7896',
                experience: '4 years',
                projects: 35
            },
            {
                id: 8,
                name: 'Intan Eksantini',
                title: 'PRODUKSI',
                department: 'Terminal',
                photo: 'https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'intan.eksantini@majasarijaya.co.id',
                phone: '+62 819-3456-7897',
                experience: '3 years',
                projects: 22
            },
            {
                id: 9,
                name: 'Kenia Intan',
                title: 'AUDITOR',
                department: 'Terminal',
                photo: 'https://images.pexels.com/photos/2182960/pexels-photo-2182960.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'kenia.intan@majasarijaya.co.id',
                phone: '+62 820-3456-7898',
                experience: '2 years',
                projects: 18
            },
            {
                id: 10,
                name: 'Jannar Dinka',
                title: 'VIDEOGRAPHER',
                department: 'Video & Media Sosial',
                photo: 'https://images.pexels.com/photos/1181605/pexels-photo-1181605.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'jannar.dinka@majasarijaya.co.id',
                phone: '+62 821-3456-7899',
                experience: '4 years',
                projects: 38
            },
            {
                id: 11,
                name: 'Audina Salfia',
                title: 'VIDEOGRAPHER',
                department: 'Video & Media Sosial',
                photo: 'https://images.pexels.com/photos/1181424/pexels-photo-1181424.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'audina.salfia@majasarijaya.co.id',
                phone: '+62 822-3456-7900',
                experience: '3 years',
                projects: 29
            },
            {
                id: 12,
                name: 'Fayzal Putra',
                title: 'VIDEOGRAPHER',
                department: 'Video & Media Sosial',
                photo: 'https://images.pexels.com/photos/1310474/pexels-photo-1310474.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'fayzal.putra@majasarijaya.co.id',
                phone: '+62 823-3456-7901',
                experience: '5 years',
                projects: 41
            },
            {
                id: 13,
                name: 'Panggih Teguh',
                title: 'VIDEOGRAPHER',
                department: 'Video & Media Sosial',
                photo: 'https://images.pexels.com/photos/1181667/pexels-photo-1181667.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'panggih.teguh@majasarijaya.co.id',
                phone: '+62 824-3456-7902',
                experience: '2 years',
                projects: 24
            },
            {
                id: 14,
                name: 'Dony Irwesa',
                title: 'MEDIA SOSIAL',
                department: 'Video & Media Sosial',
                photo: 'https://images.pexels.com/photos/1024311/pexels-photo-1024311.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'dony.irwesa@majasarijaya.co.id',
                phone: '+62 825-3456-7903',
                experience: '3 years',
                projects: 31
            },
            {
                id: 15,
                name: 'Dena Inzi Pakista',
                title: 'ILUSTRATOR',
                department: 'Video & Media Sosial',
                photo: 'https://images.pexels.com/photos/1181424/pexels-photo-1181424.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'dena.inzi.pakista@majasarijaya.co.id',
                phone: '+62 826-3456-7904',
                experience: '4 years',
                projects: 33
            },
            {
                id: 16,
                name: 'Purwasari Bayu Adi',
                title: 'MARKETING',
                department: 'Marketing',
                photo: 'https://images.pexels.com/photos/1181316/pexels-photo-1181316.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'purwasari.bayu.adi@majasarijaya.co.id',
                phone: '+62 827-3456-7905',
                experience: '6 years',
                projects: 47
            },
            {
                id: 17,
                name: 'Syafi Kapiloja',
                title: 'ACCOUNT EXECUTIVE',
                department: 'Marketing',
                photo: 'https://images.pexels.com/photos/1181605/pexels-photo-1181605.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'syafi.kapiloja@majasarijaya.co.id',
                phone: '+62 828-3456-7906',
                experience: '3 years',
                projects: 26
            },
            {
                id: 18,
                name: 'Wanda Aifia',
                title: 'ACCOUNT EXECUTIVE',
                department: 'Marketing',
                photo: 'https://images.pexels.com/photos/1181424/pexels-photo-1181424.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'wanda.aifia@majasarijaya.co.id',
                phone: '+62 829-3456-7907',
                experience: '2 years',
                projects: 19
            },
            {
                id: 19,
                name: 'Ibel S. Widodo',
                title: 'ADMINISTRASI',
                department: 'Operasional',
                photo: 'https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'ibel.s.widodo@majasarijaya.co.id',
                phone: '+62 830-3456-7908',
                experience: '7 years',
                projects: 52
            },
            {
                id: 20,
                name: 'Dina Rahmawati',
                title: 'FINANCE & ACCOUNTING',
                department: 'Operasional',
                photo: 'https://images.pexels.com/photos/1181424/pexels-photo-1181424.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'dina.rahmawati@majasarijaya.co.id',
                phone: '+62 831-3456-7909',
                experience: '5 years',
                projects: 39
            },
            {
                id: 21,
                name: 'Ega Firmani',
                title: 'SUPERVISOR',
                department: 'Operasional',
                photo: 'https://images.pexels.com/photos/1310522/pexels-photo-1310522.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'ega.firmani@majasarijaya.co.id',
                phone: '+62 832-3456-7910',
                experience: '4 years',
                projects: 34
            },
            {
                id: 22,
                name: 'Adhya Rizki',
                title: 'SENIOR HUMANISTIC',
                department: 'Operasional',
                photo: 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'adhya.rizki@majasarijaya.co.id',
                phone: '+62 833-3456-7911',
                experience: '6 years',
                projects: 43
            },
            {
                id: 23,
                name: 'Anggi Thoat',
                title: 'JUNIOR HUMANISTIC',
                department: 'Operasional',
                photo: 'https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face',
                email: 'anggi.thoat@majasarijaya.co.id',
                phone: '+62 834-3456-7912',
                experience: '2 years',
                projects: 16
            }
        ];
    }

    // Add staggered animation delays to employee cards
    addAnimationDelays() {
        const cards = document.querySelectorAll('.employee-card');
        cards.forEach((card, index) => {
            card.style.setProperty('--animation-order', index);
        });
    }

    // Add interactive functionality
    addInteractivity() {
        const cards = document.querySelectorAll('.employee-card');
        
        cards.forEach(card => {
            // Add click functionality
            card.addEventListener('click', () => {
                this.showEmployeeDetails(card);
            });

            // Add keyboard navigation
            card.setAttribute('tabindex', '0');
            card.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.showEmployeeDetails(card);
                }
            });
        });
    }

    // Show employee details in a modal
    showEmployeeDetails(card) {
        const employeeId = parseInt(card.getAttribute('data-employee-id'));
        const employee = this.employees.find(emp => emp.id === employeeId);
        
        if (!employee) return;
        
        // Create modal
        const modal = this.createModal(employee);
        document.body.appendChild(modal);
        
        // Show modal with animation
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
    }

    // Create employee details modal
    createModal(employee) {
        const modal = document.createElement('div');
        modal.className = 'employee-modal';
        modal.innerHTML = `
            <div class="modal-overlay"></div>
            <div class="modal-content">
                <button class="modal-close">&times;</button>
                <div class="modal-header">
                    <div class="modal-photo">
                        <img src="${employee.photo}" alt="${employee.name}">
                    </div>
                    <div class="modal-info">
                        <h2>${employee.name}</h2>
                        <p>${employee.title}</p>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="employee-stats">
                        <div class="stat-item">
                            <span class="stat-label">Departemen</span>
                            <span class="stat-value">${employee.department}</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Pengalaman</span>
                            <span class="stat-value">${employee.experience}</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Proyek</span>
                            <span class="stat-value">${employee.projects}</span>
                        </div>
                    </div>
                    <div class="contact-info">
                        <h3>Informasi Kontak</h3>
                        <p><strong>Email:</strong> ${employee.email}</p>
                        <p><strong>Telepon:</strong> ${employee.phone}</p>
                    </div>
                </div>
            </div>
        `;

        // Add close functionality
        modal.querySelector('.modal-close').addEventListener('click', () => {
            this.closeModal(modal);
        });

        modal.querySelector('.modal-overlay').addEventListener('click', () => {
            this.closeModal(modal);
        });

        // Add escape key handling
        const handleEscape = (e) => {
            if (e.key === 'Escape') {
                this.closeModal(modal);
                document.removeEventListener('keydown', handleEscape);
            }
        };
        document.addEventListener('keydown', handleEscape);

        return modal;
    }

    // Close modal with animation
    closeModal(modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            if (modal.parentNode) {
                modal.parentNode.removeChild(modal);
            }
        }, 300);
    }

    // Add responsive handling
    addResponsiveHandling() {
        const handleResize = () => {
            const cards = document.querySelectorAll('.employee-card');
            const isMobile = window.innerWidth <= 768;
            
            cards.forEach(card => {
                if (isMobile) {
                    card.style.minWidth = '160px';
                    card.style.maxWidth = '260px';
                } else {
                    card.style.minWidth = '200px';
                    card.style.maxWidth = '250px';
                }
            });
        };

        window.addEventListener('resize', handleResize);
        handleResize(); // Initial call
    }

    // Add search functionality
    addSearchFunctionality() {
        const searchInput = document.getElementById('employee-search');
        const clearButton = document.querySelector('.search-clear');

        searchInput.addEventListener('input', (e) => {
            this.filterEmployees(e.target.value);
            clearButton.style.display = e.target.value ? 'block' : 'none';
        });

        clearButton.addEventListener('click', () => {
            searchInput.value = '';
            this.filterEmployees('');
            clearButton.style.display = 'none';
            searchInput.focus();
        });
    }

    // Filter employees based on search term
    filterEmployees(searchTerm) {
        const cards = document.querySelectorAll('.employee-card');
        const sections = document.querySelectorAll('.org-section');
        
        searchTerm = searchTerm.toLowerCase().trim();

        cards.forEach(card => {
            const name = card.querySelector('.employee-name').textContent.toLowerCase();
            const title = card.querySelector('.employee-title').textContent.toLowerCase();
            
            const matches = name.includes(searchTerm) || title.includes(searchTerm);
            card.classList.toggle('hidden', !matches && searchTerm !== '');
        });

        // Update section visibility
        sections.forEach(section => {
            const visibleCards = section.querySelectorAll('.employee-card:not(.hidden)');
            section.classList.toggle('empty', visibleCards.length === 0 && searchTerm !== '');
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new OrganizationalChart();
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading animation
window.addEventListener('load', () => {
    document.body.classList.add('loaded');
});