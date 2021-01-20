## Eagle Athletics Database Visualizer
A web-based application for Eagle Athletics

## Project Authors
**Team Members:**
- [Nate Agcaoili](https://github.com/NateAgcaoili)
- [Earnest Hall](https://github.com/eh01014)
- [Changgyun 'Shawn' Han](https://github.com/Shawn14121)
- [Elijah Horowitz](https://github.com/ElijahHorowitz)
- [Hayden Spinos](https://github.com/hspinos)

**Project Supervisors:**
- [Dr. Rakesh Shukla](https://github.com/Rakesh-Project)
- [Angur Mahmud Jarman](https://github.com/aj16459)

## Project Description
Eagle Athletics Database Visualizer (EADV) is a web-based application for a made-up athletic clothing company, Eagle Athletics, that visualizes stored company transaction information details for both employees and clients into their respected tables within a database.  The application will keep track of information on employee sales (revenue earned, quantity of product, sold to which client, etc.)

The tables within the database will be related by common attributes.  For example, the employee table will have a primary key of ‘employee_id’ and one of the columns of said table will refer to what branch of the company the employee works for titled ‘branch_id’.  This branch column will serve as a foreign key to another table that contains the information on all the branches of the company.  Within the branch table, there will be another foreign key column for the manager of the branch called ‘manager_id’, which corresponds with the ‘employee_id’ of the manager, thus leading back to the employee table.

Different view-accesses will be implemented so that the company heads can keep track of their employees’ sale activities, employees can keep track of transactions with their clients, and clients can order more products, view their order details and purchase history, and the employees’ information that they interact with.  There will also be an option for customers to contact the company if they have any questions or concerns.
