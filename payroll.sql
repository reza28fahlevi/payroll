/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : PostgreSQL
 Source Server Version : 140005 (140005)
 Source Host           : localhost:5432
 Source Catalog        : payroll
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 140005 (140005)
 File Encoding         : 65001

 Date: 18/03/2023 17:05:52
*/


-- ----------------------------
-- Table structure for attendances
-- ----------------------------
DROP TABLE IF EXISTS "public"."attendances";
CREATE TABLE "public"."attendances" (
  "attendance_id" int4 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1
),
  "employee_id" int4,
  "time_in" varchar(10) COLLATE "pg_catalog"."default",
  "time_out" varchar(10) COLLATE "pg_catalog"."default",
  "created_at" timestamp(6),
  "updated_at" timestamp(6),
  "deleted_at" timestamp(6),
  "date" date
)
;

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS "public"."employees";
CREATE TABLE "public"."employees" (
  "employee_id" int4 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1
),
  "employee_name" varchar(255) COLLATE "pg_catalog"."default",
  "employee_departement" varchar(255) COLLATE "pg_catalog"."default",
  "employee_position" varchar(255) COLLATE "pg_catalog"."default",
  "created_at" timestamp(6),
  "updated_at" timestamp(6),
  "deleted_at" timestamp(6),
  "shift_id" int4,
  "start_date_shift" date,
  "end_date_shift" date,
  "salary" varchar(24) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for payroll
-- ----------------------------
DROP TABLE IF EXISTS "public"."payroll";
CREATE TABLE "public"."payroll" (
  "pay_id" int4 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1
),
  "employee_id" int4,
  "employee_salary" numeric(10,2),
  "created_at" timestamp(6),
  "updated_at" timestamp(6),
  "deleted_at" timestamp(6)
)
;

-- ----------------------------
-- Table structure for shifts
-- ----------------------------
DROP TABLE IF EXISTS "public"."shifts";
CREATE TABLE "public"."shifts" (
  "shift_id" int4 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1
),
  "shift_day_start" varchar(255) COLLATE "pg_catalog"."default",
  "shift_day_end" varchar(255) COLLATE "pg_catalog"."default",
  "time_in" time(6),
  "time_out" time(6),
  "created_at" timestamp(6),
  "updated_at" timestamp(6),
  "deleted_at" timestamp(6),
  "shift_name" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Primary Key structure for table attendances
-- ----------------------------
ALTER TABLE "public"."attendances" ADD CONSTRAINT "attendances_pkey" PRIMARY KEY ("attendance_id");

-- ----------------------------
-- Primary Key structure for table employees
-- ----------------------------
ALTER TABLE "public"."employees" ADD CONSTRAINT "employees_pkey" PRIMARY KEY ("employee_id");

-- ----------------------------
-- Primary Key structure for table payroll
-- ----------------------------
ALTER TABLE "public"."payroll" ADD CONSTRAINT "payroll_pkey" PRIMARY KEY ("pay_id");

-- ----------------------------
-- Primary Key structure for table shifts
-- ----------------------------
ALTER TABLE "public"."shifts" ADD CONSTRAINT "shifts_pkey" PRIMARY KEY ("shift_id");
