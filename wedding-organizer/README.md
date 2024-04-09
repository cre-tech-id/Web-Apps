<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->


<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#wedding-organizer">Wedding Organizer</a>
      <ul>
        <li><a href="#about">About</a></li>
        <li><a href="#built-with">Built With</a></li>
        <li><a href="#screenshot">Screenshot</a></li>
      </ul>
    </li>
  </ol>
</details>


## Wedding Organizer

### About

Wedding Organizer is web application designed to serve as a platform for wedding organizer. The website features an admin dashboard for monitoring user data and data inputted by wedding organizer providers. Additionally, there's a provider dashboard to process wedding organizer package data, order data, and event data. The data entered by the wedding organizer providers will be displayed on the associated <a href="https://github.com/cre-tech-id/Mobile-Apps/tree/master/Wedding-Oraganizer">Mobile Wedding Organizer</a>.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

* [![Laravel][Laravel.com]][Laravel-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![PHP][PHP.com]][PHP-url]
* [![MySQL][MySQL.com]][MySQL-url]
* [![JQuery][JQuery.com]][JQuery-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Screenshot
#### Admin Dashboard

* Register Page
  <br>Register Page contain 3 field, name, email, password, address, detail address, phone number, description of wedding organizer, and profile photo. Data that already submitted can be used for login user in login page.
  ![PhotoGrid_Site_1709312761861](https://github.com/cre-tech-id/Web-Apps/assets/56110716/7f557405-50da-4ffe-87ad-27ae0ff3173f)
  
* Login Page
Login Page contain 2 field, Email and Password. Which is email and password must be match the registration data. If user not registered yet, user can click sign up button for registration.
![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/b052bb81-8b8e-43eb-a20a-9dc65c795a82)

* Admin - Dashboard
  In Admin dashboard show information about total administrator(total admin), total wedding organizer(total penyedia), total users(total user), and total package of wedding organizer.
  ![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/1d7f43bb-af0e-438c-a9d0-6879c8914a03)
  
* Admin - Admin
  This page is for viewing data of admin, and data also can be update and delete. This menu also had add data button for add data admin.
  ![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/8588cc6e-07f9-4d1a-aec1-3b528b4c74ee)

* Admin - Add Data Admin
  If admin want to add more admin member, click button "New Admin" in previous page (Admin - Admin). There are several form columns that must be filled in, they are Nama(name), email, password, Nomor Hp(phone number), and Foto Profil(profile photo). And after form filled in correctly, click Simpan(save) button to save data.
  ![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/21436e6c-7118-4abe-b1ea-cbb616310bf8)
  
* Admin - Update Data Admin
  If user want to update the data just click the button edit(pencil & user icon) in previous page (Admin - Admin). This form include 4 field, Nama(name), Email, Nomor Hp(phone number), and Foto Profil(profile photo) which is contain data that user inputed already. After user already done updating data, user can click "Simpan" for saving data.
  ![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/0cec3d95-c2d8-4d0f-ac1c-d5741131e49e)
  
* Admin - Delete Data Admin
  To delete data just choose data that user want to delete by click the trash button, that located next to edit button in Admin - Admin page.
  ![WhatsApp Image 2024-03-02 at 00 59 19](https://github.com/cre-tech-id/Web-Apps/assets/56110716/69780678-7c18-463e-bdd0-3fdc384c399f)
  
* Admin - Penyedia(Wedding Organizer)
  This page is for viewing data of wedding organizer. Admin cannot update or add data of wedding organizer, just can delete the data and accept or reject wedding organizer.
  ![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/a60c0678-3d85-4b9d-b740-0c263cf4cbed)
  
* Admin - Confirm Penyedia (wedding organizer)
  After wedding organizer registered, admin must review data that wedding organizer filled in form. After that, if data is    valid click button "Terima" for accept wedding organizer, and click button "Tolak" if not.
  ![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/b5e9a8d2-fc2c-4701-939c-7987543bf9e0)

* Admin - Delete Data Penyedia (wedding organizer)
  To delete data just choose data that user want to delete by click the trash button, that located in Admin - Penyedia(Wedding Organizer).
  ![WhatsApp Image 2024-03-02 at 01 15 31](https://github.com/cre-tech-id/Web-Apps/assets/56110716/7debff2d-e8ad-4c7a-9995-738bc0b676f0)

* Admin - User
  This page is show user that already registered in <a href="https://github.com/cre-tech-id/Mobile-Apps/tree/master/Wedding-Oraganizer">Mobile Application</a>. And in this page only contain delete button.
  ![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/487c5985-274e-4aab-8984-57a1c086747d)
  
* Admin - Delete User
  To delete data just choose data that user want to delete by click the trash button, that located in Admin - User.
  ![WhatsApp Image 2024-03-02 at 01 23 28](https://github.com/cre-tech-id/Web-Apps/assets/56110716/49130153-b0cc-4945-b37d-2bf8b7f9276a)

* Admin - Paket(package)
  This page contains available packages that have been inputed by the wedding organizer. For admin, in this page only contain delete button.
![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/d52574eb-db56-4c6e-8973-28275c4776c4)

* Admin - Delete Paket
  To delete data just choose data that user want to delete by click the trash button, that located in Admin - Paket(package).
  ![WhatsApp Image 2024-03-02 at 01 34 11](https://github.com/cre-tech-id/Web-Apps/assets/56110716/db2c2a8c-ab8c-4b1c-86df-ee22a80be715)

* Admin - Event
  This page is only show events event to be held by Wedding Organizer.
  ![image](https://github.com/cre-tech-id/Web-Apps/assets/56110716/ed19b20f-19b4-43b3-9a97-86dba72d1df3)

* Admin - Pemesanan(order)
  This page contains information of customer order and the confirmation order from wedding organizer.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/e01fc32a-e43b-4d74-9885-6e919a342f17)

* Admin - Komentar(comments)
  This page contains feedback(comments) of customer. If there is an inappropriate word admin can delete the comments. Just click trash icon to delete comment.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/1e0077f6-bb79-41b7-a567-4b68a9467efc)


* Wedding Organizer - Paket(package)
  This page contains packages that have been inputed by the wedding organizer. Wedding Organizer can add, delete, and update data. Also in this page there is also feature that wedding organizer can manage package status, whether the package is open or close.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/2f9f8a08-f607-418b-9b06-b758c7b53b6b)
  
* Wedding Organizer - Add Paket
  Above table that contain package data, there is button add data. If wedding organizer want to add data just click the button and fill the form for insert data package. And then click button "Simpan" to save data.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/738ac4b4-7a14-4395-8fd3-14b53c9731c2)
  
* Wedding Organizer - Update Paket
  In column action from package table there is edit icon which is serves to update data. If wedding organizer want to updata data, just click the icon and update data package that wedding organizer want to. And click button "Simpan" to save data.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/b4b1d491-4c86-47fd-b754-c7415091948c)
  
* Wedding Organizer - Delete Paket
  To delete data paket just choose data that Wedding Organizer want to delete by click the trash icon next to update icon, that located in Wedding Organizer - Paket.

* Wedding Organizer - Pemesanan(order)
  This page contains information of customer order, also in this page there is button for accept or reject order. For accept order just click button "Terima" and for reject click button "Tolak".
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/e01fc32a-e43b-4d74-9885-6e919a342f17)
  
* Wedding Organizer - Event
  This page contains Event that have been inputed by the wedding organizer. Wedding Organizer can add, delete, and update data.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/ca39b4ed-bf5b-41da-96a6-e78a4c4e34fa)
  
* Wedding Organizer - Add Event
  Above table that contains event, there is button add data. If wedding organizer want to add data just click the button and fill the form for insert data event. And then click button "Simpan Data" to save data.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/0273433b-9b7b-45ad-9c21-312c4eb7e9ee)
  
* Wedding Organizer - Update Event
  In column action from package table there is edit icon which is serves to update data. If wedding organizer want to updata data, just click the icon and update data event that wedding organizer want to. And click button "Simpan" to save data.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/4eba6e24-eeb5-488a-a80e-25237b7b9dda)

* Wedding Organizer - Delete Event
  To delete data event just choose data that user want to delete by click the trash icon next to update icon, that located in Wedding Organizer - Event.

* Wedding Organizer - Pembayaran(payments)
  This page contains payments data which has been done by customers. Also this page contain button to view proof of payment, because still using manual payment method.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/20c57a8e-0681-4822-91ce-33408103fc2c)

* Wedding Organizer - Payment proof
  This page contains detail of payment proof like date and transfer receipt.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/ba890618-931c-445b-a3ea-1e1b0cc247d2)

* Wedding Organizer - Komentar(comments)
  After order completion and agenda is done, customer can give feedback about service of wedding organizer. And the feedback(comment) appear on this page.
  ![image](https://github.com/Jundix/wedding_organizer/assets/56110716/7f69e15c-5cb0-4285-b7e6-3db03821a185)



    







  











<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/othneildrew/Best-README-Template.svg?style=for-the-badge
[contributors-url]: https://github.com/othneildrew/Best-README-Template/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/othneildrew/Best-README-Template.svg?style=for-the-badge
[forks-url]: https://github.com/othneildrew/Best-README-Template/network/members
[stars-shield]: https://img.shields.io/github/stars/othneildrew/Best-README-Template.svg?style=for-the-badge
[stars-url]: https://github.com/othneildrew/Best-README-Template/stargazers
[issues-shield]: https://img.shields.io/github/issues/othneildrew/Best-README-Template.svg?style=for-the-badge
[issues-url]: https://github.com/othneildrew/Best-README-Template/issues
[license-shield]: https://img.shields.io/github/license/othneildrew/Best-README-Template.svg?style=for-the-badge
[license-url]: https://github.com/othneildrew/Best-README-Template/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/othneildrew
[product-screenshot]: images/screenshot.png
[Next.js]: https://img.shields.io/badge/next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white
[Next-url]: https://nextjs.org/
[React.js]: https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Angular.io]: https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white
[Angular-url]: https://angular.io/
[Svelte.dev]: https://img.shields.io/badge/Svelte-4A4A55?style=for-the-badge&logo=svelte&logoColor=FF3E00
[Svelte-url]: https://svelte.dev/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[MySQL.com]: https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://www.mysql.com/
[codeigniter.com]: https://img.shields.io/badge/CodeIgniter-%23EF4223.svg?style=for-the-badge&logo=codeIgniter&logoColor=white
[codeigniter-url]: https://www.codeigniter.com/
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com
[PHP.com]: https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net/
