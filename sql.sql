CREATE DATABASE Xk;
USE Xk;

--创建系部表Department
CREATE TABLE Department(
	DepartNo char(2) NOT NULL PRIMARY KEY,
	DepartName char(20) NOT NULL
)default charset=utf8;

--创建班级表Class
CREATE TABLE Class(
	ClassNo char(8) NOT NULL PRIMARY KEY,
	DepartNo char(2) NOT NULL,
	ClassName char(20) NOT NULL,
	CONSTRAINT FOREIGN KEY(DepartNo) REFERENCES Department(DepartNo)
)default charset=utf8;

--创建课程表Course
CREATE TABLE Course(
	CouNo char(3) NOT NULL PRIMARY KEY,
	CouName char(30) NOT NULL,
	Kind char(8) NOT NULL,
	Credit decimal(5) NOT NULL,
	Teacher char(20) NOT NULL,
	DepartNo char(2) NOT NULL,
	SchookTime char(10) NOT NULL,
	LimitNum decimal(5) NOT NULL,
	ChooseNum decimal(5) NOT NULL
)default charset=utf8;

--创建学生表
CREATE TABLE Student(
	StuNo char(8) NOT NULL PRIMARY KEY,
	ClassNo char(8) NOT NULL,
	StuName char(10) NOT NULL,
	Pwd char(8) NOT NULL,
	CONSTRAINT FOREIGN KEY(ClassNo) REFERENCES Department(ClassNo)
)default charset=utf8;

--创建教学秘书表Teacher
CREATE TABLE Teacher(
	TeaNo char(8) NOT NULL PRIMARY KEY,
	DepartNo char(2) NOT NULL,
	TeaName char(10) NOT NULL,
	Pwd char(8) NOT NULL,
	CONSTRAINT FOREIGN KEY(DepartNo) REFERENCES Department(DepartNo)
)default charset=utf8;

--创建学生选课表StuCou
CREATE TABLE StuCou (
	StuNo char(8) NOT NULL,
	CouNo char(3) NOT NULL,
	WillOrder smallint NOT NULL,
	State char(2) NOT NULL,
	RandomNum char(50) NOT NULL,
	PRIMARY KEY(StuNo, CouNo),
	CONSTRAINT FOREIGN KEY(StuNo) REFERENCES Student(StuNo),
	CONSTRAINT FOREIGN KEY(CouNo) REFERENCES Course(CouNo)
)default charset=utf8;