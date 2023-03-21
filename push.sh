#!/bin/sh

SYNC_USER="www-data";
SYNC_HNAME="abbad.luciaillanes.de";
SYNC_DNAME="www.luciaillanes.de";

git push "${@}" || exit 1;
ssh	-l "${SYNC_USER}"	\
	"${SYNC_HNAME}"		\
	'
	set -o xtrace;
	set -o noglob -o errexit -o nounset;
	cd "'"${SYNC_DNAME}"'";
	git pull --rebase origin;
	';
