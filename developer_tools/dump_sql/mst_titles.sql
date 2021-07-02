INSERT INTO "mst_titles" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (1, 1, 1, NULL, '2016-6-30 16:59:36', '2016-6-30 16:59:36', NULL, 'Mr.', 1);
INSERT INTO "mst_titles" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (2, 1, 1, NULL, '2016-6-30 16:59:41', '2016-6-30 16:59:41', NULL, 'Mrs.', 2);
INSERT INTO "mst_titles" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (3, 1, 1, NULL, '2016-6-30 16:59:51', '2016-7-12 16:44:40', NULL, 'Miss', 3);

ALTER SEQUENCE mst_titles_id_seq RESTART WITH 4;