public::	CurriculumVitae.tex
		texi2pdf -c -t '\\newcommand{\\varLang}[0]{ngerman}' -t '\\newcommand{\\varPrivate}[0]{0}' $<
		mv CurriculumVitae.pdf "Curriculum Vitae (öffentliche Version, ohne Referenzen).pdf"
		texi2pdf -c -t '\\newcommand{\\varLang}[0]{british}' -t '\\newcommand{\\varPrivate}[0]{0}' $<
		mv CurriculumVitae.pdf "Curriculum Vitae (public version, excludes character references).pdf"

private::	CurriculumVitae.tex
		texi2pdf -c -t '\\newcommand{\\varLang}[0]{ngerman}' -t '\\newcommand{\\varPrivate}[0]{1}' $<
		mv CurriculumVitae.pdf "private/Curriculum Vitae (private Version, mit Referenzen).pdf"
		texi2pdf -c -t '\\newcommand{\\varLang}[0]{british}' -t '\\newcommand{\\varPrivate}[0]{1}' $<
		mv CurriculumVitae.pdf "private/Curriculum Vitae (private version, includes character references).pdf"
