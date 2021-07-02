INSERT INTO "mst_occupations" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (1, 1, 1, NULL, '2016-6-30 16:57:17', '2016-6-30 16:57:17', NULL, 'Student', 1);
INSERT INTO "mst_occupations" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (2, 1, 1, NULL, '2016-6-30 16:57:24', '2016-6-30 16:57:24', NULL, 'Business', 2);
INSERT INTO "mst_occupations" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (3, 1, 1, NULL, '2016-6-30 16:57:31', '2016-6-30 16:57:31', NULL, 'Self-Employed', 3);
INSERT INTO "mst_occupations" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (4, 1, 1, NULL, '2016-6-30 16:57:37', '2016-7-12 16:44:25', NULL, 'Others', 4);

ALTER SEQUENCE mst_occupations_id_seq RESTART WITH 5;