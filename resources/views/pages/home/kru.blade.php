@extends('layouts.app')

@section('title')
    Arena Lomba
@endsection

@section('content')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <h1 class="page-title">Kru Mojok</h1>
            
            <!-- Organizational Chart -->
            <div class="org-chart">
                <!-- Leadership Level -->
                <div class="org-level leadership">
                    <div class="employee-card leadership-card">
                        <div class="employee-photo">
                            <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Puthut EA">
                        </div>
                        <h3 class="employee-name">Puthut EA</h3>
                        <p class="employee-title">DIREKTUR KHUSUS PRIMA</p>
                    </div>
                    
                    <div class="employee-card leadership-card">
                        <div class="employee-photo">
                            <img src="https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Agung Purwandono">
                        </div>
                        <h3 class="employee-name">Agung Purwandono</h3>
                        <p class="employee-title">PEMIMPIN SETIJAB / PENANGGUNG JAWAB</p>
                    </div>
                </div>

                <!-- Department: Liputan -->
                <div class="org-section">
                    <h2 class="department-title">DEPARTEMEN LIPUTAN</h2>
                    <div class="org-level">
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1310522/pexels-photo-1310522.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="M. Aly Reza">
                            </div>
                            <h3 class="employee-name">M. Aly Reza</h3>
                            <p class="employee-title">KOORDINATOR</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Ahmad Umndi">
                            </div>
                            <h3 class="employee-name">Ahmad Umndi</h3>
                            <p class="employee-title">REPORTER</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181519/pexels-photo-1181519.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Asyiah Aurita">
                            </div>
                            <h3 class="employee-name">Asyiah Aurita</h3>
                            <p class="employee-title">REPORTER</p>
                        </div>
                    </div>
                </div>

                <!-- Department: Terminal -->
                <div class="org-section">
                    <h2 class="department-title">DEPARTEMEN TERMINAL</h2>
                    <div class="org-level">
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Purius Soro Witomo">
                            </div>
                            <h3 class="employee-name">Purius Soro Witomo</h3>
                            <p class="employee-title">KAMERAMAN</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1024311/pexels-photo-1024311.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Rizky Prasarya">
                            </div>
                            <h3 class="employee-name">Rizky Prasarya</h3>
                            <p class="employee-title">EDITOR</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Intan Eksantini">
                            </div>
                            <h3 class="employee-name">Intan Eksantini</h3>
                            <p class="employee-title">PRODUKSI</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Kenia Intan">
                            </div>
                            <h3 class="employee-name">Kenia Intan</h3>
                            <p class="employee-title">AUDITOR</p>
                        </div>
                    </div>
                </div>

                <!-- Department: Video dan Media Sosial -->
                <div class="org-section">
                    <h2 class="department-title">DEPARTEMEN VIDEO DAN MEDIA SOSIAL</h2>
                    <div class="org-level">
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181605/pexels-photo-1181605.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Jannar Dinka">
                            </div>
                            <h3 class="employee-name">Jannar Dinka</h3>
                            <p class="employee-title">VIDEOGRAPHER</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181424/pexels-photo-1181424.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Audina Salfia">
                            </div>
                            <h3 class="employee-name">Audina Salfia</h3>
                            <p class="employee-title">VIDEOGRAPHER</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1310474/pexels-photo-1310474.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Fayzal Putra">
                            </div>
                            <h3 class="employee-name">Fayzal Putra</h3>
                            <p class="employee-title">VIDEOGRAPHER</p>
                        </div>
                    </div>
                    
                    <div class="org-level">
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181667/pexels-photo-1181667.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Panggih Teguh">
                            </div>
                            <h3 class="employee-name">Panggih Teguh</h3>
                            <p class="employee-title">VIDEOGRAPHER</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1024311/pexels-photo-1024311.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Dony Irwesa">
                            </div>
                            <h3 class="employee-name">Dony Irwesa</h3>
                            <p class="employee-title">MEDIA SOSIAL</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181424/pexels-photo-1181424.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Dena Inzi Pakista">
                            </div>
                            <h3 class="employee-name">Dena Inzi Pakista</h3>
                            <p class="employee-title">ILUSTRATOR</p>
                        </div>
                    </div>
                </div>

                <!-- Department: Marketing -->
                <div class="org-section">
                    <h2 class="department-title">DEPARTEMEN MARKETING</h2>
                    <div class="org-level">
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181316/pexels-photo-1181316.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Purwasari Bayu Adi">
                            </div>
                            <h3 class="employee-name">Purwasari Bayu Adi</h3>
                            <p class="employee-title">MARKETING</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181605/pexels-photo-1181605.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Syafi Kapiloja">
                            </div>
                            <h3 class="employee-name">Syafi Kapiloja</h3>
                            <p class="employee-title">ACCOUNT EXECUTIVE
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181424/pexels-photo-1181424.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Wanda Aifia">
                            </div>
                            <h3 class="employee-name">Wanda Aifia</h3>
                            <p class="employee-title">ACCOUNT EXECUTIVE</p>
                        </div>
                    </div>
                </div>

                <!-- Department: Operasional -->
                <div class="org-section">
                    <h2 class="department-title">DEPARTEMEN OPERASIONAL</h2>
                    <div class="org-level">
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Ibel S. Widodo">
                            </div>
                            <h3 class="employee-name">Ibel S. Widodo</h3>
                            <p class="employee-title">ADMINISTRASI</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1181424/pexels-photo-1181424.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Dina Rahmawati">
                            </div>
                            <h3 class="employee-name">Dina Rahmawati</h3>
                            <p class="employee-title">FINANCE & ACCOUNTING</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/1310522/pexels-photo-1310522.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Ega Firmani">
                            </div>
                            <h3 class="employee-name">Ega Firmani</h3>
                            <p class="employee-title">SUPERVISOR</p>
                        </div>
                    </div>
                    
                    <div class="org-level">
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Adhya Rizki">
                            </div>
                            <h3 class="employee-name">Adhya Rizki</h3>
                            <p class="employee-title">SENIOR HUMANISTIC</p>
                        </div>
                        
                        <div class="employee-card">
                            <div class="employee-photo">
                                <img src="https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop&crop=face" alt="Anggi Thoat">
                            </div>
                            <h3 class="employee-name">Anggi Thoat</h3>
                            <p class="employee-title">JUNIOR HUMANISTIC</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')