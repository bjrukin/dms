INSERT INTO "mst_designations" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (1, 1, 1, NULL, '2016-6-30 17:00:04', '2016-6-30 17:00:04', NULL, 'Sales Executive', 1);
INSERT INTO "mst_designations" ("id", "created_by", "updated_by", "deleted_by", "created_at", "updated_at", "deleted_at", "name", "rank") VALUES (2, 1, 1, NULL, '2016-6-30 17:00:12', '2016-6-30 17:00:12', NULL, 'Team Leader', 2);

ALTER SEQUENCE mst_designations_id_seq RESTART WITH 3;