<?php

/* model/database.php
 * Contains database queries for Dating app
 *
 */
/**
 * SQL Statements:
 *
 * MEMBER TABLE:
 *
 * CREATE TABLE member(
 * member_id INT(3) not null AUTO_INCREMENT primary key,
 * fname varchar(50) not null,
 * lname varchar(50) not null,
 * age int(3) not null,
 * gender varchar(10),
 * phone varchar(20),
 * email varchar(100),
 * state varchar(100),
 * seeking varchar(10),
 * bio varchar(1000),
 * premium tinyint,
 * interests varchar(100),
 * image varchar(100)
 * );
 *
 */


class Database
{
    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * insert query to insert member into database
     * @param $member member object passed in
     */
    function insertMember($member)
    {
        /* INSERT QUERY */

        //Define the query
        $sql = "INSERT INTO member(fname, lname, age, gender, phone, email, state, seeking, bio, premium, interests)
    VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :interests)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':fname', $member->getFname(), PDO::PARAM_STR);
        $statement->bindParam(':lname', $member->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $member->getAge(), PDO::PARAM_INT);
        $statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':state', $member->getState(), PDO::PARAM_STR);
        $statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
        $statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
        $premium = $member instanceof PremiumMember ? 1 : 0;
        $statement->bindParam(':premium', $premium, PDO::PARAM_INT);
        if ($premium == 1) {
            $interests = $member->getIndoorInterests() . $member->getOutdoorInterests();
        } else {
            $interests = "";
        }
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

        //Execute
        $statement->execute();

    }

    /**
     * query that returns rows from table
     */
    function getMembers()
    {
        /* SELECT QUERY WITH FETCHALL (gets multiple rows) */

        //Define the query
        $sql = "SELECT * FROM member ORDER BY lname";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute the statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * gets member associated with passed in id
     *
     * @param $member_id passed in id of member
     */
    function getMember($member_id)
    {
        /* SELECT QUERY WITH FETCH (gets one row) */

        //Define the query
        $sql = "SELECT * FROM member WHERE member_id = :member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $id = $member_id;
        $statement->bindParam(':member_id', $id, PDO::PARAM_INT);

        //Execute the statement
        $statement->execute();

        //Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        echo $row['fname'] . ", " . $row['lname'] . ", " . $row['age'] . ", " .
            $row['gender'] . ", " . $row['phone'] . ", " . $row['email'] . ", " .
            $row['state'] . ", " . $row['seeking'] . ", " . $row['bio'] . ", " .
            $row['premium'] . ", " . $row['interests'];

    }

    /**
     * gets interests of member associated with passed in id
     *
     * @param $member_id passed in id of member
     */
    function getInterests($member_id)
    {
        /* SELECT QUERY WITH FETCH (gets one row) */

        //Define the query
        $sql = "SELECT * FROM member WHERE member_id = :member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $id = $member_id;
        $statement->bindParam(':member_id', $id, PDO::PARAM_INT);

        //Execute the statement
        $statement->execute();

        //Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        echo $row['interests'];

    }

}