<?php

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

/**
 *
 * Class Database
 */
class Database
{
    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

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

    function getMembers()
    {
        /* SELECT QUERY WITH FETCHALL (gets multiple rows) */

        //Define the query
        $sql = "SELECT * FROM member";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute the statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getMember($member_id)
    {

    }

    function getInterests($member_id)
    {

    }

}