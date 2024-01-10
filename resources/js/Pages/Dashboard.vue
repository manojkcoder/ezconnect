<script setup>
import AuthenticatedUserLayout from '@/Layouts/AuthenticatedUserLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedUserLayout>
        <main class="content dashboard-content flex-row">
            <div class="full-row">
                    <div class="select-form mb-0">
                        <select>
                            <option value="Today">Today</option>
                            <option value="Yesterday">Yesterday</option>
                            <option value="This Week">This Week</option>
                            <option value="Last Week">Last Week</option>
                            <option value="This Month">This Month</option>
                            <option value="Last Month">Last Month</option>
                            <option value="Last 3 Months">Last 3 Months</option>
                        </select>
                        <img class="select-icon" src="../../images/icons/select-icon.svg" alt="Select">
                        <img class="select-dropdown" src="../../images/icons/dropdown-arrow.svg" alt="Dropdown">
                    </div>
                </div>
                <div class="dashLeft">
                    <div class="top-cards flex-row">
                        <!-- Card 1-->
                        <div class="card performace-card">
                            <div>
                                <span class="numberr">5</span>
                                <span class="icreament"> <span><img src="../../images/icons/up-arrow.svg"
                                            alt="Increament"></span> 5</span>
                            </div>

                            <div class="performace-icons">
                                <a href=""><img src="../../images/icons/view-gray-icon.svg">View</a>
                                <a href=""><img src="../../images/icons/info-icon.svg"></a>
                            </div>
                        </div>
                        <!-- Card 2-->
                        <div class="card performace-card">
                            <div>
                                <span class="numberr">0</span>
                                <span class="decreament"> <span><img src="../../images/icons/decreament-icon.svg"
                                            alt="Increament"></span> 0</span>
                            </div>

                            <div class="performace-icons">
                                <a href=""><img src="../../images/icons/tap-links-icon.svg">Link Taps</a>
                                <a href=""><img src="../../images/icons/info-icon.svg"></a>
                            </div>
                        </div>

                        <!-- Card 3-->
                        <div class="card performace-card">
                            <div>
                                <span class="numberr">0.00%</span>
                            </div>

                            <div class="performace-icons">
                                <a href=""><img src="../../images/icons/rate-icon.svg">Tap through rate</a>
                                <a href=""><img src="../../images/icons/info-icon.svg"></a>
                            </div>
                        </div>
                    </div>
                    <!---  Top Card  Row  End  -->
                    <h1 class="full-field contact-requests-heading">Contact Requests</h1>
                    <section class="section contactRequestSection">
                        <div class="container">
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!---  Table   Row  1-->
                                        <tr>
                                            <td>
                                                <a href="#" class="profile-picture">
                                                    <span class="img-wrapper">
                                                        <img src="../../images/sam-porter.png" alt="Jane cooper">
                                                    </span>
                                                    <span class="name"> Sam Porter</span>
                                                </a>
                                            </td>
                                            <td>722 East Gates St.Valrico, FL 33594</td>
                                            <td>9876543210</td>
                                            <td>samporter@gmail.com</td>
                                            <td>Tues, Nov 28, 2023</td>
                                            <td class="action">
                                                <div class="flex-row">
                                                    <label class="switch">
                                                        <input type="checkbox">
                                                        <span class="switch-toggle"></span>
                                                    </label>
                                                    <a class="delete"><img src="../../images/icons/delete-profile-icon.svg"
                                                            alt="Delete"></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!---  Table   Row  2-->
                                        <tr>
                                            <td>
                                                <a href="#" class="profile-picture">
                                                    <span class="img-wrapper">
                                                        <img src="../../images/nia-hillyer.png" alt="Nia Hillyer">
                                                    </span>
                                                    <span class="name">Nia Hillyer</span>
                                                </a>
                                            </td>
                                            <td>531 York St.Ocean Springs, MS 39564</td>
                                            <td>7896543210</td>
                                            <td>niahillyer@gmail.com</td>
                                            <td>Tues, Nov 28, 2023</td>
                                            <td class="action">
                                                <div class="flex-row">
                                                    <label class="switch">
                                                        <input type="checkbox">
                                                        <span class="switch-toggle"></span>
                                                    </label>
                                                    <a class="delete"><img src="../../images/icons/delete-profile-icon.svg"
                                                            alt="Delete"></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!---  Table   Row  3-->
                                        <tr>
                                            <td>
                                                <a href="#" class="profile-picture">
                                                    <span class="img-wrapper">
                                                        <img src="../../images/sean-freeman.jpg" alt="Sean Freeman">
                                                    </span>
                                                    <span class="name">Sean Freeman</span>
                                                </a>
                                            </td>
                                            <td>9597 Talbot CircleSumter, SC 29150</td>
                                            <td>8976543210</td>
                                            <td>seanfreman@gmail.com</td>
                                            <td>Tues, Nov 28, 2023</td>
                                            <td class="action">
                                                <div class="flex-row">
                                                    <label class="switch">
                                                        <input type="checkbox">
                                                        <span class="switch-toggle"></span>
                                                    </label>
                                                    <a class="delete"><img src="../../images/icons/delete-profile-icon.svg"
                                                            alt="Delete"></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!---  Table   Row  4-->
                                        <tr>
                                            <td>
                                                <a href="#" class="profile-picture">
                                                    <span class="img-wrapper">
                                                        <img src="../../images/alama-clark.jpg" alt="Alma Clarke">
                                                    </span>
                                                    <span class="name">Alma Clarke</span>
                                                </a>
                                            </td>
                                            <td>64 Fordham St.Lemont, IL 60439</td>
                                            <td>9856320456</td>
                                            <td>almaclarke@gmail.com</td>
                                            <td>Tues, Nov 28, 2023</td>
                                            <td class="action">
                                                <div class="flex-row">
                                                    <label class="switch">
                                                        <input type="checkbox">
                                                        <span class="switch-toggle"></span>
                                                    </label>
                                                    <a class="delete"><img src="../../images/icons/delete-profile-icon.svg"
                                                            alt="Delete"></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!---  Table   Row  5-->
                                        <tr>
                                            <td>
                                                <a href="#" class="profile-picture">
                                                    <span class="img-wrapper">
                                                        <img src="../../images/alan-green.jpg" alt="Alan Green">
                                                    </span>
                                                    <span class="name">Alan Green</span>
                                                </a>
                                            </td>
                                            <td>641 W. Sheffield Rd.Fuquay Varina, NC 27526</td>
                                            <td>7766805610</td>
                                            <td>alengreen@ymail.com</td>
                                            <td>Tues, Nov 28, 2023</td>
                                            <td class="action">
                                                <div class="flex-row">
                                                    <label class="switch">
                                                        <input type="checkbox">
                                                        <span class="switch-toggle"></span>
                                                    </label>
                                                    <a class="delete"><img src="../../images/icons/delete-profile-icon.svg"
                                                            alt="Delete"></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a class="linktext" href="../user/contact-requests.html">View All Contact Requests</a>

                        </div>
                    </section>

                </div>
                <div class="dashRight">
                    <div class="card app-overview-card">
                        <h2>Apps Overview</h2>
                        <ul class="apps-overview-list">
                            <li>
                                <span class="icons"><img src="../../images/icons/app-view-facebook-icon.svg" alt="Facebook">
                                    Facebook </span>
                                <span class="taps-number"><strong>0</strong> Taps</span>
                            </li>
                            <li>
                                <span class="icons"><img src="../../images/icons/twitterIcon.svg" alt="Twitter"> Twitter</span>
                                <span class="taps-number"><strong>0</strong> Taps</span>
                            </li>
                            <li>
                                <span class="icons"><img src="../../images/icons/instagramIcon.svg" alt="Instagram">Instagram
                                </span>
                                <span class="taps-number"><strong>0</strong> Taps</span>
                            </li>
                            <li>
                                <span class="icons"><img src="../../images/icons/LinkedinIcon.svg"
                                        alt="LinkedIn">LinkedIn</span>
                                <span class="taps-number"><strong>0</strong> Taps</span>
                            </li>
                        </ul>
                    </div>

                <div class="card app-overview-card">
                    <h2>Contact Engagement</h2>
                    <ul class="apps-overview-list">
                        <li><span class="icons"><img src="../../images/icons/Phn-icon.svg" alt="Phone Number">Phone
                                Number</span> <span class="taps-number"><strong>0</strong> Taps</span></li>
                        <li><span class="icons"><img src="../../images/icons/email-envelope-icon.svg"
                                    alt="Email">Email</span> <span class="taps-number"><strong>0</strong> Taps</span></li>
                        <li><span class="icons"><img src="../../images/icons/link-icon.svg" alt="URL">URL</span> <span
                                class="taps-number"><strong>0</strong> Taps</span></li>
                        <li><span class="icons"><img src="../../images/icons/save-icon.svg" alt="Save Contact">Save
                                Contact</span> <span class="taps-number"><strong>0</strong> Taps</span></li>
                    </ul>
                </div>
            </div>
        </main>
    </AuthenticatedUserLayout>
</template>
