INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (1, 1, 1, NULL, NULL, NULL, NULL, 'Pending', 1);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (2, 1, 1, NULL, NULL, NULL, NULL, 'Confirmed', 2);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (3, 1, 1, NULL, NULL, NULL, NULL, 'Booked', 3);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (4, 1, 1, NULL, NULL, NULL, NULL, 'Quotation Issued', 4);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (5, 1, 1, NULL, NULL, NULL, NULL, 'Reject Before Doc Completion', 5);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (6, 1, 1, NULL, NULL, NULL, NULL, 'Document Complete', 6);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (7, 1, 1, NULL, NULL, NULL, NULL, 'Reject After Doc Completion', 7);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (8, 1, 1, NULL, NULL, NULL, NULL, 'DO Approval', 8);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (9, 1, 1, NULL, NULL, NULL, NULL, 'Vehicle Deliver', 9);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (10, 1, 1, NULL, NULL, NULL, NULL, 'DO in Hand', 10);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (11, 1, 1, NULL, NULL, NULL, NULL, 'DO not in Hand', 11);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (12, 1, 1, NULL, NULL, NULL, NULL, 'Ownership Transfer', 12);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (13, 1, 1, NULL, NULL, NULL, NULL, 'Send for Payment', 13);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (14, 1, 1, NULL, NULL, NULL, NULL, 'Payment Received', 14);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (15, 1, 1, NULL, NULL, NULL, NULL, 'Retail', 15);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (16, 1, 1, NULL, NULL, NULL, NULL, 'Lost', 16);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (17, 1, 1, NULL, NULL, NULL, NULL, 'Cancel', 17);
INSERT INTO "mst_inquiry_statuses" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (18, 1, 1, NULL, NULL, NULL, NULL, 'Closed', 18);


ALTER SEQUENCE mst_inquiry_statuses_id_seq RESTART WITH 19;